<?php

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
            $body = $response->body();
            throw new \Exception('Erreur API Groq : ' . $response->status() . ' - ' . $body);
        }

        $content = $response->json('choices.0.message.content');

        $content = preg_replace('/```json|```/', '', $content);
        $content = trim($content);

        $questions = json_decode($content, true);

        if (!is_array($questions) || count($questions) !== 5) {
            throw new \Exception('Format de réponse invalide reçu de l\'API.');
        }

        return $questions;
    }
}