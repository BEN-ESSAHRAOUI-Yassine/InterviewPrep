<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConceptRequest;
use App\Http\Requests\UpdateConceptRequest;
use App\Models\Concept;
use App\Models\Domain;
use Illuminate\Http\Request;

class ConceptController extends Controller
{
    public function index(Domain $domain, Request $request)
    {
        $this->authorize('view', $domain);

        $query = $domain->concepts();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $concepts = $query->get();

        return view('concepts.index', compact('domain', 'concepts'));
    }

    public function create(Domain $domain)
    {
        $this->authorize('view', $domain);

        return view('concepts.create', compact('domain'));
    }

    public function store(StoreConceptRequest $request, Domain $domain)
    {
        $this->authorize('view', $domain);

        $domain->concepts()->create([
            ...$request->validated(),
            'status' => 'to_review',
        ]);

        return redirect()->route('domains.concepts.index', $domain)->with('success', 'Concept créé avec succès.');
    }

    public function show(Domain $domain, Concept $concept)
    {
        $this->authorize('view', $domain);

        $concept->load('generatedQuestions');

        return view('concepts.show', compact('domain', 'concept'));
    }

    public function edit(Domain $domain, Concept $concept)
    {
        $this->authorize('view', $domain);

        return view('concepts.edit', compact('domain', 'concept'));
    }

    public function update(UpdateConceptRequest $request, Domain $domain, Concept $concept)
    {
        $this->authorize('view', $domain);

        $concept->update($request->validated());

        return redirect()->route('domains.concepts.index', $domain)->with('success', 'Concept mis à jour.');
    }

    public function destroy(Domain $domain, Concept $concept)
    {
        $this->authorize('view', $domain);

        $concept->delete();

        return redirect()->route('domains.concepts.index', $domain)->with('success', 'Concept supprimé.');
    }

    public function updateStatus(Request $request, Concept $concept)
    {
        $this->authorize('view', $concept->domain);

        $request->validate([
            'status' => 'required|in:to_review,in_progress,mastered',
        ]);

        $concept->update(['status' => $request->status]);

        return back()->with('success', 'Statut mis à jour.');
    }
}