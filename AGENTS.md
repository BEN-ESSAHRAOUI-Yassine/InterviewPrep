# AGENTS.md — InterviewPrep

## Projet
**InterviewPrep** — Application Laravel de préparation aux entretiens techniques avec génération AI de questions via l'API Groq.

## Coding Agent utilisé
**Claude Code** (`claude.ai/code`) — utilisé en mode **Plan** puis **Build** pour chaque feature.

## AI API
**Groq API** (`console.groq.com`) — free tier, zéro carte bancaire, ultra-rapide.
Modèle : `llama3-8b-8192`
Appel via `Http::` facade Laravel natif — zéro package externe.

---

## Stack technique
| Composant | Choix |
|-----------|-------|
| Framework | Laravel 11 |
| Base de données | MySQL 8 |
| Frontend | Blade + Tailwind CSS |
| Auth | Laravel Breeze |
| Debug | Laravel Debugbar (zéro N+1) |
| AI | Groq API via `Http::` |
| Agent | Claude Code |

---

## Workflow AI-Assisted — Règles du projet

### 1. Mode Plan avant Build (obligatoire)
Pour chaque nouvelle feature, l'agent est d'abord utilisé en **mode Plan** :
- Décrire la feature en langage naturel
- Préciser ce qu'on veut ET ce qu'on **ne veut pas**
- Valider le plan avant de lancer le Build

### 2. Structure des specs
Chaque feature a son fichier dans `specs/` :
```
specs/
  auth.md
  domains-crud.md
  concepts-crud.md
  ai-generation.md
  dashboard.md
```

### 3. Convention de commits
Tout commit impliquant l'agent doit mentionner l'usage AI :

```
feat(domains): CRUD complet domains [AI-assisted: Claude Code]
fix(concepts): correction filtre statut [AI-reviewed]
refactor(ai): extraction service Groq [AI-generated, manually edited]
```

### 4. Ce que l'agent NE doit PAS faire
- ❌ Utiliser des packages tiers pour les appels API AI
- ❌ Stocker la clé API ailleurs que dans `.env`
- ❌ Générer des migrations sans types explicites
- ❌ Créer des controllers sans Form Request classes
- ❌ Oublier `with()` sur les relations (N+1)
- ❌ Mélanger logique métier dans les controllers (→ Services)

### 5. Ce que l'agent DOIT faire
- ✅ Respecter la structure MVC stricte de Laravel
- ✅ Utiliser `withCount()` pour les stats de domaines
- ✅ Ajouter les Accessors `statusLabel()` et `difficultyLabel()` sur le modèle Concept
- ✅ Gérer les erreurs API avec `try/catch` et message utilisateur propre
- ✅ Sauvegarder le résultat AI en base avant affichage

---

## Architecture cible

```
app/
  Http/
    Controllers/
      DomainController.php
      ConceptController.php
      GeneratedQuestionController.php
    Requests/
      StoreDomainRequest.php
      UpdateDomainRequest.php
      StoreConceptRequest.php
      UpdateConceptRequest.php
  Models/
    User.php
    Domain.php
    Concept.php
    GeneratedQuestion.php
  Services/
    GroqService.php
resources/
  views/
    domains/
    concepts/
    questions/
    dashboard.blade.php
specs/
AGENTS.md
```

---

## Relations Eloquent

```
User          → hasMany → Domain
Domain        → belongsTo → User
Domain        → hasMany → Concept
Concept       → belongsTo → Domain
Concept       → hasMany → GeneratedQuestion
GeneratedQuestion → belongsTo → Concept
```

---

## Variables d'environnement requises

```env
GROQ_API_KEY=your_key_here
GROQ_API_URL=https://api.groq.com/openai/v1/chat/completions
GROQ_MODEL=llama3-8b-8192
```

---

## Branches Git

| Branche | Feature |
|---------|---------|
| `main` | Production stable |
| `feature/auth` | Authentification |
| `feature/domains-crud` | CRUD Domaines |
| `feature/concepts-crud` | CRUD Concepts |
| `feature/ai-generation` | Génération AI |
| `feature/dashboard` | Dashboard stats |

---

## Checklist avant chaque PR

- [ ] Zéro requête N+1 vérifiée avec Debugbar
- [ ] Form Request présent pour chaque action de création/modification
- [ ] Clé API absente du code source
- [ ] Erreur API gérée avec message utilisateur
- [ ] Tests manuels des cas limites effectués
- [ ] Fichier spec correspondant mis à jour dans `specs/`
