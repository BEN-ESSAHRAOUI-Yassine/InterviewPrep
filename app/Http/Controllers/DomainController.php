<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomainRequest;
use App\Http\Requests\UpdateDomainRequest;
use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::withCount([
            'concepts',
            'concepts as mastered_count' => fn($q) => $q->where('status', 'mastered'),
        ])->get();

        return view('domains.index', compact('domains'));
    }

    public function create()
    {
        return view('domains.create');
    }

    public function store(StoreDomainRequest $request)
    {
        auth()->user()->domains()->create($request->validated());

        return redirect()->route('mes-domaines')->with('success', 'Domaine créé avec succès.');
    }

    public function show(Domain $domain)
    {
        $this->authorize('view', $domain);

        $domain->loadCount([
            'concepts',
            'concepts as mastered_count' => fn($q) => $q->where('status', 'mastered'),
        ]);

        return view('domains.show', compact('domain'));
    }

    public function edit(Domain $domain)
    {
        $this->authorize('view', $domain);

        return view('domains.edit', compact('domain'));
    }

    public function update(UpdateDomainRequest $request, Domain $domain)
    {
        $this->authorize('view', $domain);

        $domain->update($request->validated());

        return redirect()->route('mes-domaines')->with('success', 'Domaine mis à jour.');
    }

    public function destroy(Domain $domain)
    {
        $this->authorize('view', $domain);

        $domain->delete();

        return redirect()->route('mes-domaines')->with('success', 'Domaine supprimé.');
    }
}