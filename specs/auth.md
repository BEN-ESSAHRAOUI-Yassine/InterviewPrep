# Spec — Feature : Authentification (US1)

## Contexte
Mise en place du système d'inscription, connexion et déconnexion.
Toutes les features suivantes dépendent de cette base.

---

## User Story
> En tant qu'utilisateur, je veux créer mon compte, me connecter et me déconnecter.

---

## Ce que je VEUX

- Installation de **Laravel Breeze** (Blade + Tailwind) pour scaffolding rapide
- Routes protégées par middleware `auth` pour tout ce qui n'est pas auth
- Redirection vers `/dashboard` après connexion réussie
- Redirection vers `/` (page de login) après déconnexion
- Messages de validation en français sur les champs du formulaire
- Le champ `name`, `email`, `password` suffisent à l'inscription

## Ce que je NE VEUX PAS

- ❌ Pas de vérification d'email (email verification désactivée)
- ❌ Pas de socialite / OAuth / login Google
- ❌ Pas de 2FA
- ❌ Pas de customisation poussée des vues Breeze pour l'instant — on personnalisera le layout après
- ❌ Pas de rôles ou permissions (un seul type d'utilisateur)

---

## Plan validé avec l'agent

### Étape 1 — Installation
```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
php artisan migrate
```

### Étape 2 — Configuration
- Désactiver `MustVerifyEmail` sur le modèle `User`
- Vérifier que `APP_URL` est correct dans `.env`

### Étape 3 — Middleware
- Grouper toutes les routes métier sous `middleware('auth')` dans `routes/web.php`
- La route `/` redirige vers `/dashboard` si connecté, sinon vers `/login`

### Étape 4 — Tests manuels
| Scénario | Résultat attendu |
|----------|-----------------|
| Inscription avec données valides | Compte créé, redirigé vers `/dashboard` |
| Inscription avec email déjà pris | Message d'erreur sur le champ email |
| Inscription avec password < 8 chars | Message d'erreur sur le champ password |
| Login avec mauvais password | Message d'erreur générique |
| Login valide | Redirigé vers `/dashboard` |
| Déconnexion | Redirigé vers `/login`, session détruite |
| Accès à `/domains` sans être connecté | Redirigé vers `/login` |

---

## Fichiers créés / modifiés

| Fichier | Action | Généré par |
|---------|--------|-----------|
| `routes/web.php` | Modification — groupement auth | Manuel |
| `app/Models/User.php` | Modification — retrait MustVerifyEmail | Agent |
| `resources/views/layouts/app.blade.php` | Modification — nav avec logout | Agent |
| Migration `create_users_table` | Breeze par défaut | Agent (Breeze) |

---

## Ce que l'agent a bien fait
- Scaffolding complet Breeze en une commande
- Structure des vues propre et cohérente avec Tailwind

## Ce que j'ai modifié manuellement
- Ajout du lien vers `/domains` dans la navbar générée par Breeze
- Traduction des messages de validation dans `lang/fr/validation.php`
- Suppression des routes de vérification d'email dans `web.php`

---

## Commit associé
```
feat(auth): inscription/connexion/déconnexion avec Laravel Breeze [AI-assisted: Claude Code]
```
