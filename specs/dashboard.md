# Spec — Feature : Dashboard de progression (Bonus)

## Contexte
Page d'accueil après connexion. Donne une vue globale de la préparation de l'utilisateur :
combien de concepts par statut, quel domaine est le plus avancé, lequel a le plus de travail.

---

## Ce que je VEUX

- Statistiques globales en haut de page :
  - Nombre total de concepts
  - Nombre de concepts "À revoir"
  - Nombre de concepts "En cours"
  - Nombre de concepts "Maîtrisés"
  - Pourcentage global de maîtrise
- **Domaine le mieux maîtrisé** : celui avec le plus grand ratio `mastered / total`
- **Domaine le plus à revoir** : celui avec le plus grand nombre de concepts `to_review`
- Liste des domaines avec barre de progression visuelle

## Ce que je NE VEUX PAS

- ❌ Pas de graphiques Chart.js ou librairies JS externes
- ❌ Pas de calculs complexes côté JS — tout en PHP/Blade
- ❌ Pas de données en temps réel (pas de polling ou WebSocket)

---

## Plan validé avec l'agent

### Étape 1 — Route et Controller

```php
// Réutiliser le HomeController ou créer DashboardController
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
```

### Étape 2 — Requêtes optimisées (zéro N+1)

```php
public function index()
{
    $user = auth()->user();

    // Tous les domaines avec count par statut
    $domains = $user->domains()
        ->withCount([
            'concepts',
            'concepts as to_review_count'   => fn($q) => $q->where('status', 'to_review'),
            'concepts as in_progress_count' => fn($q) => $q->where('status', 'in_progress'),
            'concepts as mastered_count'    => fn($q) => $q->where('status', 'mastered'),
        ])
        ->get();

    // Stats globales
    $stats = [
        'total'       => $domains->sum('concepts_count'),
        'to_review'   => $domains->sum('to_review_count'),
        'in_progress' => $domains->sum('in_progress_count'),
        'mastered'    => $domains->sum('mastered_count'),
    ];

    $stats['percent'] = $stats['total'] > 0
        ? round(($stats['mastered'] / $stats['total']) * 100)
        : 0;

    // Domaine le mieux maîtrisé (ratio mastered/total, min 1 concept)
    $bestDomain = $domains
        ->filter(fn($d) => $d->concepts_count > 0)
        ->sortByDesc(fn($d) => $d->mastered_count / $d->concepts_count)
        ->first();

    // Domaine le plus à revoir
    $worstDomain = $domains->sortByDesc('to_review_count')->first();

    return view('dashboard', compact('domains', 'stats', 'bestDomain', 'worstDomain'));
}
```

### Étape 3 — Vue `dashboard.blade.php`

#### Cards de stats
```
[📚 Total : 24]  [🔴 À revoir : 10]  [🟡 En cours : 8]  [🟢 Maîtrisés : 6]
[Progression globale : 25%] ████░░░░░░░░
```

#### Highlights
```
🏆 Domaine le mieux maîtrisé : PHP OOP (80%)
⚠️  Domaine prioritaire : MySQL (8 concepts à revoir)
```

#### Barre de progression par domaine (Tailwind)
```html
<div class="w-full bg-gray-200 rounded-full h-2.5">
    <div class="bg-green-500 h-2.5 rounded-full"
         style="width: {{ $domain->concepts_count > 0 ? round($domain->mastered_count / $domain->concepts_count * 100) : 0 }}%">
    </div>
</div>
```

---

## Tests manuels

| Scénario | Résultat attendu |
|----------|-----------------|
| Aucun domaine | "Créez votre premier domaine" CTA |
| Domaine sans concepts | Barre à 0%, pas d'erreur division par zéro |
| Tous concepts maîtrisés | Progression globale 100%, barre verte complète |
| Nouveau concept ajouté | Stats mises à jour au prochain chargement |

---

## Fichiers créés / modifiés

| Fichier | Action | Généré par |
|---------|--------|-----------|
| `app/Http/Controllers/DashboardController.php` | Création | Agent |
| `resources/views/dashboard.blade.php` | Création | Agent + retouches |
| `routes/web.php` | Modification — route `/dashboard` | Manuel |

---

## Ce que l'agent a bien fait
- `withCount` avec conditions multiples en une seule requête
- Calcul du ratio avec protection division par zéro

## Ce que j'ai modifié manuellement
- Design des cards de stats (couleurs, icônes emoji)
- CTA "Créez votre premier domaine" quand `$domains->isEmpty()`
- Protection `$stats['total'] > 0` pour le pourcentage global

---

## Commits associés
```
feat(dashboard): DashboardController avec stats agrégées [AI-assisted: Claude Code]
feat(dashboard): vue Blade dashboard avec barres de progression [AI-assisted: Claude Code, manually edited]
```
