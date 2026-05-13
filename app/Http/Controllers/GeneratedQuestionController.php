<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Domain;
use App\Models\GeneratedQuestion;
use App\Services\GroqService;
use Illuminate\Http\Request;

class GeneratedQuestionController extends Controller
{
    public function __construct(private GroqService $groqService) {}

    public function store(Domain $domain, Concept $concept)
    {
        if ($concept->domain_id !== $domain->id || $domain->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            $questions = $this->groqService->generateInterviewQuestions(
                $concept->title,
                $concept->explanation
            );

            $concept->generatedQuestions()->create([
                'questions' => $questions,
            ]);

            return redirect()->route('domains.concepts.show', [$domain, $concept])
                             ->with('success', '5 questions générées avec succès !');

        } catch (\Exception $e) {
            return back()->with('error', 'Impossible de générer les questions : ' . $e->getMessage());
        }
    }

    public function destroy(GeneratedQuestion $generatedQuestion)
    {
        if ($generatedQuestion->concept->domain->user_id !== auth()->id()) {
            abort(403);
        }

        $generatedQuestion->delete();

        return back()->with('success', 'Questions supprimées.');
    }

    public function restore(GeneratedQuestion $generatedQuestion)
    {
        if ($generatedQuestion->concept->domain->user_id !== auth()->id()) {
            abort(403);
        }

        $generatedQuestion->restore();

        return back()->with('success', 'Questions restaurées.');
    }

    public function forceDelete(GeneratedQuestion $generatedQuestion)
    {
        if ($generatedQuestion->concept->domain->user_id !== auth()->id()) {
            abort(403);
        }

        $generatedQuestion->forceDelete();

        return back()->with('success', 'Questions supprimées définitivement.');
    }

    public function history()
    {
        $deletedQuestions = GeneratedQuestion::onlyTrashed()
            ->whereHas('concept', function ($query) {
                $query->whereHas('domain', function ($q) {
                    $q->where('user_id', auth()->id());
                });
            })
            ->with(['concept', 'concept.domain'])
            ->latest('deleted_at')
            ->get();

        return view('questions.history', compact('deletedQuestions'));
    }
}