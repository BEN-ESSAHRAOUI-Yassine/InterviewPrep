# Spec — Feature : CRUD Domaines (US2, US3, US4)

## Contexte
Les domaines sont le premier niveau de l'arborescence : `User → Domain → Concept`.
Chaque utilisateur gère ses propres domaines techniques (ex: "Laravel ORM", "PHP OOP", "MySQL").

---

## User Stories

**US2** — En tant qu'utilisateur connecté, je veux voir la liste de tous mes domaines avec le nombre de concepts total et le nombre de concepts maîtrisés.

**US3** — En tant qu'utilisateur connecté, je veux créer un domaine avec un nom et une couleur de badge.

**US4** — En tant qu'utilisateur connecté, je veux modifier ou supprimer un domaine.

---

## Ce que je VEUX

- **Liste** : affichage en cards avec nom, badge couleur, compteurs `X concepts / Y maîtrisés`
- **Création** : formulaire avec champ `name` (texte) et `color` (color picker ou sélection parmi 6-8 couleurs prédéfinies)
- **Modification** : même formulaire, pré-rempli
- **Suppression** : confirmation avant suppression — si le domaine a des concepts, les supprimer en cascade (`onDelete('cascade')` en DB)
- Isolation par utilisateur : `WHERE user_id = auth()->id()` partout — un user ne voit jamais les domaines d'un autre
- Utiliser `withCount(['concepts', 'concepts as mastered_count' => fn($q) => $q->where('status', 'mastered')])` pour les stats sans N+1

## Ce que je NE VEUX PAS

- ❌ Pas de pagination pour l'instant (peu de domaines par utilisateur)
- ❌ Pas de drag & drop pour réordonner
- ❌ Pas de domaines publics / partagés
- ❌ Pas de sous-domaines (hiérarchie à 2 niveaux max : Domain → Concept)
- ❌ Pas de suppression douce (soft delete) sur les domaines — seulement sur les concepts (bonus)
- ❌ Le champ `color` ne doit PAS être un input hex libre — choisir parmi des valeurs prédéfinies Tailwind

---

## Plan validé avec l'agent

### Étape 1 — Migration

```php
Schema::create('domains', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('name');
    $table->string('color')->default('blue'); // valeur Tailwind: blue, green, red, purple, orange, yellow, pink, gray
    $table->timestamps();
});
```

### Étape 2 — Modèle `Domain`

```php
// Relations
public function user(): BelongsTo
public function concepts(): HasMany

// Fillable
protected $fillable = ['name', 'color', 'user_id'];
```

### Étape 3 — Form Requests

`StoreDomainRequest` :
```php
'name'  => 'required|string|max:100',
'color' => 'required|in:blue,green,red,purple,orange,yellow,pink,gray',
```

`UpdateDomainRequest` : identique à Store.

### Étape 4 — Controller `DomainController`

Méthodes : `index`, `create`, `store`, `edit`, `update`, `destroy`

```php
// index — withCount pour les stats
$domains = auth()->user()->domains()
    ->withCount([
        'concepts',
        'concepts as mastered_count' => fn($q) => $q->where('status', 'mastered')
    ])
    ->get();
```

### Étape 5 — Routes

```php
Route::middleware('auth')->group(function () {
    Route::resource('domains', DomainController::class);
});
```

### Étape 6 — Vues Blade

| Vue | Description |
|-----|-------------|
| `domains/index.blade.php` | Grille de cards |
| `domains/create.blade.php` | Formulaire création |
| `domains/edit.blade.php` | Formulaire modification |

### Couleurs prédéfinies (mapping Tailwind)
```php
const COLORS = [
    'blue'   => 'bg-blue-100 text-blue-800',
    'green'  => 'bg-green-100 text-green-800',
    'red'    => 'bg-red-100 text-red-800',
    'purple' => 'bg-purple-100 text-purple-800',
    'orange' => 'bg-orange-100 text-orange-800',
    'yellow' => 'bg-yellow-100 text-yellow-800',
    'pink'   => 'bg-pink-100 text-pink-800',
    'gray'   => 'bg-gray-100 text-gray-800',
];
```

---

## Tests manuels

| Scénario | Résultat attendu |
|----------|-----------------|
| Créer un domaine avec nom valide | Apparu dans la liste avec badge coloré |
| Créer un domaine sans nom | Erreur de validation sur `name` |
| Voir la liste avec 3 concepts dont 2 maîtrisés | "3 concepts / 2 maîtrisés" |
| Modifier la couleur d'un domaine | Badge mis à jour |
| Supprimer un domaine avec des concepts | Domaine ET concepts supprimés |
| Accéder à `/domains/{id}` d'un autre user | 403 ou 404 |

---

## Fichiers créés / modifiés

| Fichier | Action | Généré par |
|---------|--------|-----------|
| `database/migrations/..._create_domains_table.php` | Création | Agent |
| `app/Models/Domain.php` | Création | Agent |
| `app/Http/Controllers/DomainController.php` | Création | Agent |
| `app/Http/Requests/StoreDomainRequest.php` | Création | Agent |
| `app/Http/Requests/UpdateDomainRequest.php` | Création | Agent |
| `resources/views/domains/` | Création (3 vues) | Agent + retouches manuelles |
| `routes/web.php` | Modification | Manuel |

---

## Ce que l'agent a bien fait
- Migration propre avec FK et cascade
- `withCount` avec condition correctement généré
- Form Request avec règle `in:` pour les couleurs

## Ce que j'ai modifié manuellement
- Design des cards dans la vue `index` (grille responsive, badge coloré)
- Ajout de la confirmation JavaScript `confirm()` avant suppression
- Vérification que `user_id` est injecté depuis le controller et non depuis le formulaire

---

## Commits associés
```
feat(domains): migration et modèle Domain [AI-assisted: Claude Code]
feat(domains): CRUD complet DomainController + Form Requests [AI-assisted: Claude Code]
feat(domains): vues Blade liste/create/edit domaines [AI-assisted: Claude Code, manually edited]
```
