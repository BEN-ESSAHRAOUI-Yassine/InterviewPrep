# Spec — Feature : Génération AI de questions d'entretien (US11, US12, US13)

## Contexte
C'est la feature clé du projet. Depuis la page détail d'un concept, l'utilisateur peut générer
5 questions d'entretien techniques réalistes en utilisant l'API Groq (modèle LLaMA 3).
Les générations sont sauvegardées et consultables ultérieurement.

---

## User Stories

**US11** — Cliquer "Générer des questions d'entretien" depuis le détail d'un concept → recevoir 5 questions générées par l'AI, sauvegardées en base.

**US12** — Voir l'historique de toutes les générations passées pour un concept.

**US13** — Supprimer un lot de questions générées.

---

## Ce que je VEUX

- Appel via **`Http::` facade Laravel natif** — zéro package externe (pas de SDK Groq)
- Clé API dans `.env` uniquement — `GROQ_API_KEY`, jamais dans le code
- **5 questions par génération** — stockées dans un JSON ou en colonne `text` parsée
- Résultat **sauvegardé en base avant affichage** — jamais affiché "à la volée" sans sauvegarde
- Gestion d'erreur propre : si l'API échoue → message flash d'erreur, pas de page blanche
- Un `GeneratedQuestion` représente **un lot de 5 questions** (une ligne en base par génération)
- Affichage de l'historique : générations triées par date décroissante, avec date et questions listées
- Extraction d'un **`GroqService`** pour isoler la logique d'appel API

## Ce que je NE VEUX PAS

- ❌ Pas de package `openai-php/client` ou autre SDK tiers
- ❌ Pas de streaming de la réponse (réponse complète attendue)
- ❌ Pas de régénération automatique en cas d'échec (un seul essai, message d'erreur si ça rate)
- ❌ Pas de possibilité d'éditer les questions générées — lecture seule
- ❌ Pas de limite d'affichage sur l'historique pour l'instant (peu de générations par concept)
- ❌ Le prompt ne doit PAS être exposé à l'utilisateur — il est fixe dans le service

---

## Plan validé avec l'agent

### Étape 1 — Migration

```php
Schema::create('generated_questions', function (Blueprint $table) {
    $table->id();
    $table->foreignId('concept_id')->constrained()->onDelete('cascade');
    $table->json('questions'); // tableau de 5 strings
    $table->timestamps();
});
```

### Étape 2 — Modèle `GeneratedQuestion`

```php
protected $fillable = ['concept_id', 'questions'];

protected $casts = [
    'questions' => 'array', // auto-désérialisation JSON
];

// Relation
public function concept(): BelongsTo
```

### Étape 3 — `.env` et `config/services.php`

```env
GROQ_API_KEY=gsk_xxxxxxxxxxxxxxxxxxxx
GROQ_API_URL=https://api.groq.com/openai/v1/chat/completions
GROQ_MODEL=llama3-8b-8192
```

```php
// config/services.php
'groq' => [
    'api_key' => env('GROQ_API_KEY'),
    'api_url' => env('GROQ_API_URL', 'https://api.groq.com/openai/v1/chat/completions'),
    'model'   => env('GROQ_MODEL', 'llama3-8b-8192'),
],
```

### Étape 4 — `GroqService`

```php
// app/Services/GroqService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GroqService
{
    public function generateInterviewQuestions(string $title, string $explanation): array
    {
        $prompt = <<<PROMPT
Tu es un expert technique en développement web. Génère exactement 5 questions d'entretien
techniques réalistes pour le concept suivant.

Concept : {$title}
Explication : {$explanation}

Réponds UNIQUEMENT avec un tableau JSON de 5 strings. Exemple :
["Question 1 ?", "Question 2 ?", "Question 3 ?", "Question 4 ?", "Question 5 ?"]

Aucun texte avant ou après le JSON.
PROMPT;

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.groq.api_key'),
            'Content-Type'  => 'application/json',
        ])->post(config('services.groq.api_url'), [
            'model'    => config('services.groq.model'),
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
            'max_tokens'  => 800,
        ]);

        if ($response->failed()) {
            throw new \Exception('Erreur API Groq : ' . $response->status());
        }

        $content = $response->json('choices.0.message.content');

        // Nettoyage du JSON (parfois l'AI ajoute des backticks)
        $content = preg_replace('/```json|```/', '', $content);
        $content = trim($content);

        $questions = json_decode($content, true);

        if (!is_array($questions) || count($questions) !== 5) {
            throw new \Exception('Format de réponse invalide reçu de l\'API.');
        }

        return $questions;
    }
}
```

### Étape 5 — Controller `GeneratedQuestionController`

```php
// Injection du service via le constructeur
public function __construct(private GroqService $groqService) {}

// store — génère et sauvegarde
public function store(Concept $concept)
{
    try {
        $questions = $this->groqService->generateInterviewQuestions(
            $concept->title,
            $concept->explanation
        );

        $concept->generatedQuestions()->create([
            'questions' => $questions,
        ]);

        return redirect()->route('concepts.show', [$concept->domain_id, $concept])
                         ->with('success', '5 questions générées avec succès !');

    } catch (\Exception $e) {
        return back()->with('error', 'Impossible de générer les questions : ' . $e->getMessage());
    }
}

// destroy — supprime un lot
public function destroy(GeneratedQuestion $generatedQuestion)
{
    $conceptId = $generatedQuestion->concept_id;
    $generatedQuestion->delete();
    return back()->with('success', 'Questions supprimées.');
}
```

### Étape 6 — Routes

```php
Route::middleware('auth')->group(function () {
    Route::post('concepts/{concept}/questions', [GeneratedQuestionController::class, 'store'])
         ->name('questions.store');
    Route::delete('questions/{generatedQuestion}', [GeneratedQuestionController::class, 'destroy'])
         ->name('questions.destroy');
});
```

### Étape 7 — Vue `concepts/show.blade.php`

Structure de la page détail d'un concept :

```
[Titre du concept] [Badge niveau] [Badge statut]

--- Explication ---
[Texte de l'explication]

--- Générer ---
[Bouton "Générer des questions d'entretien"] → POST /concepts/{id}/questions

--- Historique des générations ---
[Génération du 12/05/2026 à 14h30]  [Bouton Supprimer]
  1. Question 1 ?
  2. Question 2 ?
  ...

[Génération du 11/05/2026 à 09h15]  [Bouton Supprimer]
  ...
```

---

## Prompt Engineering — Décisions

| Décision | Justification |
|----------|---------------|
| Demander un JSON pur (pas de markdown) | Facilite le parsing, évite les backticks |
| `temperature: 0.7` | Assez créatif pour varier, assez stable pour être pertinent |
| Inclure l'explication dans le prompt | Meilleure qualité de questions, adaptées au niveau de l'utilisateur |
| 5 questions exactement demandées | Cohérence avec le stockage et l'affichage |

---

## Gestion des erreurs

| Cas | Comportement |
|-----|-------------|
| API Groq inaccessible (réseau) | `Http::` throw → catch → message flash rouge |
| Réponse HTTP 429 (rate limit) | catch → message "Trop de requêtes, réessayer dans quelques secondes" |
| JSON malformé dans la réponse | Vérification `is_array` → message "Format invalide" |
| Moins ou plus de 5 questions | Vérification `count()` → message d'erreur |

---

## Tests manuels

| Scénario | Résultat attendu |
|----------|-----------------|
| Générer questions sur concept valide | 5 questions affichées, sauvegardées en base |
| Générer 2 fois | 2 lots dans l'historique, les plus récents en premier |
| API Key invalide | Message d'erreur "Impossible de générer", pas de page blanche |
| Supprimer un lot | Lot disparu de l'historique |
| Supprimer le lot d'un autre user | 403 |

---

## Sécurité

- Vérifier que `$concept->domain->user_id === auth()->id()` avant toute action
- Ne jamais exposer `GROQ_API_KEY` dans les logs ou les réponses
- `$concept_id` en FK protège contre l'injection de concepts étrangers

---

## Fichiers créés / modifiés

| Fichier | Action | Généré par |
|---------|--------|-----------|
| `database/migrations/..._create_generated_questions_table.php` | Création | Agent |
| `app/Models/GeneratedQuestion.php` | Création | Agent |
| `app/Services/GroqService.php` | Création | Agent + retouches manuelles |
| `app/Http/Controllers/GeneratedQuestionController.php` | Création | Agent |
| `config/services.php` | Modification | Manuel |
| `.env.example` | Modification — ajout clés Groq | Manuel |
| `resources/views/concepts/show.blade.php` | Modification | Agent + retouches |
| `routes/web.php` | Modification | Manuel |

---

## Ce que l'agent a bien fait
- Structure du `GroqService` avec injection dans le controller
- Cast `'questions' => 'array'` sur le modèle pour auto-sérialisation JSON
- Gestion du try/catch dans le controller avec redirect et flash message

## Ce que j'ai modifié manuellement
- Nettoyage regex des backticks dans la réponse AI (l'agent n'avait pas anticipé ce cas)
- Ajout de la vérification `count($questions) !== 5` (hallucination potentielle de l'AI)
- Rédaction du prompt final — l'agent avait généré un prompt trop vague, j'ai précisé le format JSON attendu

---

## Commits associés
```
feat(ai): migration et modèle GeneratedQuestion [AI-assisted: Claude Code]
feat(ai): GroqService avec appel Http:: et parsing JSON [AI-assisted: Claude Code, manually edited]
feat(ai): GeneratedQuestionController store/destroy [AI-assisted: Claude Code]
feat(ai): intégration bouton génération + historique dans concepts/show [AI-assisted: Claude Code, manually edited]
fix(ai): nettoyage backticks réponse Groq + validation count questions [manually written]
```
