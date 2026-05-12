<?php

namespace Database\Seeders;

use App\Models\Concept;
use App\Models\Domain;
use App\Models\User;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first() ?? User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $domains = [
            [
                'name' => 'Laravel ORM',
                'color' => 'blue',
                'concepts' => [
                    ['title' => 'Eloquent Relationships', 'explanation' => 'Maîtriser les relations Eloquent: hasOne, hasMany, belongsTo, belongsToMany, polymorphic. Comprendre quand utiliser chaque type et comment structurer vos modèles.', 'difficulty' => 'mid', 'status' => 'mastered'],
                    ['title' => 'Eloquent N+1 Problem', 'explanation' => 'Le problème N+1 survient quand on charge des relations sans eager loading. Utiliser with() ou load() pour optimiser les requêtes. Exemple: $users->load("posts.comments").', 'difficulty' => 'mid', 'status' => 'in_progress'],
                    ['title' => 'Query Builder vs Eloquent', 'explanation' => 'Comparer l\'utilisation du Query Builder raw vs Eloquent ORM. Quand utiliser chacun: query builder pour des requêtes complexes, eloquent pour le CRUD standard.', 'difficulty' => 'junior', 'status' => 'to_review'],
                    ['title' => 'Mass Assignment Protection', 'explanation' => 'Comprendre $fillable et $guarded pour protéger contre le mass assignment. Utiliser fill() uniquement avec les champs autorisés dans $fillable.', 'difficulty' => 'junior', 'status' => 'mastered'],
                ],
            ],
            [
                'name' => 'PHP OOP',
                'color' => 'green',
                'concepts' => [
                    ['title' => 'SOLID Principles', 'explanation' => 'Les 5 principes SOLID: Single Responsibility, Open/Closed, Liskov Substitution, Interface Segregation, Dependency Inversion. Comment les appliquer dans un projet Laravel.', 'difficulty' => 'senior', 'status' => 'mastered'],
                    ['title' => 'Design Patterns', 'explanation' => 'Patterns couramment utilisés: Factory, Repository, Strategy, Observer. Implémenter ces patterns dans des contextes Laravel réels.', 'difficulty' => 'senior', 'status' => 'in_progress'],
                    ['title' => 'Namespaces and Autoloading', 'explanation' => 'Comprendre le système de namespaces en PHP et l\'autoloading PSR-4. Comment organiser son code avec les namespaces et les use statements.', 'difficulty' => 'junior', 'status' => 'mastered'],
                ],
            ],
            [
                'name' => 'MySQL',
                'color' => 'purple',
                'concepts' => [
                    ['title' => 'Index Optimization', 'explanation' => 'Comment créer et utiliser les index pour optimiser les performances. Index simples, composites, full-text. Savoir quand un index est utile ou contre-productif.', 'difficulty' => 'mid', 'status' => 'to_review'],
                    ['title' => 'Query Optimization', 'explanation' => 'Techniques d\'optimisation des requêtes: EXPLAIN, analyse du plan d\'exécution, avoidance des full table scans, optimisation des JOINs.', 'difficulty' => 'senior', 'status' => 'to_review'],
                    ['title' => 'Transactions ACID', 'explanation' => 'Comprendre les propriétés ACID des transactions: Atomicité, Cohérence, Isolation, Durabilité. Comment utiliser les transactions dans Laravel.', 'difficulty' => 'mid', 'status' => 'in_progress'],
                ],
            ],
            [
                'name' => 'Vue.js',
                'color' => 'orange',
                'concepts' => [
                    ['title' => 'Reactivity System', 'explanation' => 'Le système de réactivité de Vue 3 avec les refs et reactive. Comprendre comment Vue détecte les changements et met à jour le DOM.', 'difficulty' => 'mid', 'status' => 'to_review'],
                    ['title' => 'Composition API', 'explanation' => 'Migrer du Options API au Composition API. Utiliser setup(), composables, et lifecycle hooks. Avantages par rapport à l\'Options API.', 'difficulty' => 'mid', 'status' => 'to_review'],
                ],
            ],
        ];

        foreach ($domains as $domainData) {
            $domain = Domain::create([
                'user_id' => $user->id,
                'name' => $domainData['name'],
                'color' => $domainData['color'],
            ]);

            foreach ($domainData['concepts'] as $conceptData) {
                Concept::create([
                    'domain_id' => $domain->id,
                    ...$conceptData,
                ]);
            }
        }
    }
}