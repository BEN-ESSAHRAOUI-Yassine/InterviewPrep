# Spec — Feature : CRUD Concepts (US5 → US10)

## Contexte
Les concepts sont le cœur de l'application. Chaque concept appartient à un domaine et représente
un sujet technique que l'utilisateur veut maîtriser (ex: "Eloquent N+1 Problem", "SOLID Principles").

---

## User Stories

**US5** — Liste des concepts d'un domaine avec titre, niveau (Junior/Mid/Senior), statut (À revoir/En cours/Maîtrisé), filtre par statut.

**US6** — Créer un concept : titre, explication, niveau de difficulté, statut initial "à revoir".

**US7** — Voir le détail d'un concept avec ses questions générées.

**US8** — Modifier titre, explication, difficulté ou statut.

**US9** — Changer le statut rapidement depuis la liste (sans ouvrir le formulaire).

**US10** — Supprimer un concept.

---

## Ce que je VEUX

- **Accessors** sur le modèle `Concept` :
  - `statusLabel()` → `'to_review' => 'À revoir'`, `'in_progress' => 'En cours'`, `'mastered' => 'Maîtrisé'`
  - `difficultyLabel()` → `'junior' => 'Junior'`, `'mid' => 'Mid'`, `'senior' => 'Senior'`
- **Filtre par statut** via query string `?status=mastered` — côté controller, pas JS
- **Changement rapide de statut** (US9) : bouton/lien dans la liste qui envoie un PATCH vers une route dédiée `concepts/{concept}/status` — pas de rechargement de page si possible (sinon redirect simple)
- **Explication** : textarea longue (pas de rich text, Markdown simple suffit)
- Statut par défaut à la création : `to_review`
- Soft delete (bonus) : `SoftDeletes` trait sur le modèle, colonne `deleted_at`

## Ce que je NE VEUX PAS

- ❌ Pas d'éditeur WYSIWYG (TinyMCE, Quill...) — textarea basique
- ❌ Pas de tags ou catégories supplémentaires — juste le domaine parent
- ❌ Pas d'import CSV de concepts
- ❌ Pas de système de notes/score numériques — uniquement les 3 statuts
- ❌ Le statut ne doit PAS être modifiable depuis le formulaire principal (US8) — il a sa propre route (US9). **Exception** : on peut autoriser la modification depuis `edit` si c'est plus naturel UX, mais la route rapide DOIT exister.
- ❌ Pas de réponses aux questions dans cette feature (ça c'est la feature AI)

---

## Plan validé avec l'agent

### Étape 1 — Migration

```php
Schema::create('concepts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('domain_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->text('explanation');
    $table->enum('difficulty', ['junior', 'mid', 'senior'])->default('junior');
    $table->enum('status', ['to_review', 'in_progress', 'mastered'])->default('to_review');
    $table->softDeletes(); // bonus
    $table->timestamps();
});
```

### Étape 2 — Modèle `Concept`

```php
use SoftDeletes;

protected $fillable = ['domain_id', 'title', 'explanation', 'difficulty', 'status'];

// Relations
public function domain(): BelongsTo
public function generatedQuestions(): HasMany

// Accessors
public function getStatusLabelAttribute(): string
{
    return match($this->status) {
        'to_review'   => 'À revoir',
        'in_progress' => 'En cours',
        'mastered'    => 'Maîtrisé',
        default       => '—',
    };
}

public function getDifficultyLabelAttribute(): string
{
    return match($this->difficulty) {
        'junior' => 'Junior',
        'mid'    => 'Mid',
        'senior' => 'Senior',
        default  => '—',
    };
}
```

### Étape 3 — Form Requests

`StoreConceptRequest` :
```php
'title'       => 'required|string|max:200',
'explanation' => 'required|string|min:20',
'difficulty'  => 'required|in:junior,mid,senior',
// status non requis — défaut to_review dans le controller
```

`UpdateConceptRequest` : même règles + `'status' => 'sometimes|in:to_review,in_progress,mastered'`

### Étape 4 — Controller `ConceptController`

```php
// index — filtre par statut + éviter N+1 sur domain
public function index(Domain $domain, Request $request)
{
    $this->authorize('view', $domain); // ou check manuel user_id
    $query = $domain->concepts();
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }
    $concepts = $query->get();
    return view('concepts.index', compact('domain', 'concepts'));
}

// updateStatus — route dédiée pour US9
public function updateStatus(Concept $concept, Request $request)
{
    $request->validate(['status' => 'required|in:to_review,in_progress,mastered']);
    $concept->update(['status' => $request->status]);
    return back()->with('success', 'Statut mis à jour.');
}
```

### Étape 5 — Routes

```php
Route::middleware('auth')->group(function () {
    Route::resource('domains.concepts', ConceptController::class);
    Route::patch('concepts/{concept}/status', [ConceptController::class, 'updateStatus'])
         ->name('concepts.updateStatus');
});
```

### Étape 6 — Vues Blade

| Vue | Description |
|-----|-------------|
| `concepts/index.blade.php` | Liste avec filtres, boutons statut rapide |
| `concepts/create.blade.php` | Formulaire création |
| `concepts/edit.blade.php` | Formulaire modification |
| `concepts/show.blade.php` | Détail + zone questions générées |

### Badges de statut (Tailwind)
```
to_review   → bg-red-100 text-red-700
in_progress → bg-yellow-100 text-yellow-700
mastered    → bg-green-100 text-green-700

junior → bg-sky-100 text-sky-700
mid    → bg-indigo-100 text-indigo-700
senior → bg-rose-100 text-rose-700
```

### Bouton changement rapide de statut (US9)
Dans la liste, afficher 3 petits boutons ou un `<select>` qui envoie un PATCH :
```html
<form method="POST" action="/concepts/{{ $concept->id }}/status">
    @method('PATCH')
    @csrf
    <select name="status" onchange="this.form.submit()">
        <option value="to_review"   @selected($concept->status === 'to_review')>À revoir</option>
        <option value="in_progress" @selected($concept->status === 'in_progress')>En cours</option>
        <option value="mastered"    @selected($concept->status === 'mastered')>Maîtrisé</option>
    </select>
</form>
```

---

## Bonus — Soft Deletes

- Page `/concepts/archived` listant les concepts supprimés (`withTrashed()->whereNotNull('deleted_at')`)
- Bouton "Restaurer" qui appelle `restore()` sur le concept
- La suppression normale (`destroy`) fait un soft delete automatiquement grâce au trait

---

## Tests manuels

| Scénario | Résultat attendu |
|----------|-----------------|
| Créer concept sans titre | Erreur validation |
| Créer concept avec explication < 20 chars | Erreur validation |
| Filtrer par statut "mastered" | Seulement les concepts maîtrisés |
| Changer statut via select | Page rechargée, badge mis à jour |
| Ouvrir détail concept | Titre, explication, niveau, statut, zone questions |
| Supprimer concept | Disparu de la liste (soft delete : dans archived) |
| Accéder au concept d'un autre user | 403 ou 404 |

---

## Fichiers créés / modifiés

| Fichier | Action | Généré par |
|---------|--------|-----------|
| `database/migrations/..._create_concepts_table.php` | Création | Agent |
| `app/Models/Concept.php` | Création (avec accessors) | Agent |
| `app/Http/Controllers/ConceptController.php` | Création | Agent |
| `app/Http/Requests/StoreConceptRequest.php` | Création | Agent |
| `app/Http/Requests/UpdateConceptRequest.php` | Création | Agent |
| `resources/views/concepts/` | Création (4 vues) | Agent + retouches |
| `routes/web.php` | Modification | Manuel |

---

## Ce que l'agent a bien fait
- Accessors `statusLabel` et `difficultyLabel` avec `match()` correctement générés
- Route imbriquée `domains.concepts` avec `Domain $domain` en paramètre
- Filtre `?status=` proprement géré sans N+1

## Ce que j'ai modifié manuellement
- Ajout du `<select>` inline pour le changement rapide (l'agent avait généré 3 boutons séparés, moins pratique)
- Vérification du `user_id` via `$domain->user_id === auth()->id()` dans chaque action
- Mise en forme des badges couleur dans les vues

---

## Commits associés
```
feat(concepts): migration et modèle Concept avec softDeletes [AI-assisted: Claude Code]
feat(concepts): ConceptController CRUD complet + Form Requests [AI-assisted: Claude Code]
feat(concepts): route updateStatus pour changement rapide US9 [AI-assisted: Claude Code, manually edited]
feat(concepts): vues Blade concepts index/show/create/edit [AI-assisted: Claude Code, manually edited]
feat(concepts): page archivés avec restauration (bonus) [AI-assisted: Claude Code]
```
