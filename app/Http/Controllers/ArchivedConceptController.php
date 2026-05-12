<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use Illuminate\Http\Request;

class ArchivedConceptController extends Controller
{
    public function index()
    {
        $concepts = Concept::withTrashed()
            ->whereNotNull('deleted_at')
            ->whereHas('domain', fn($q) => $q->where('user_id', auth()->id()))
            ->with('domain')
            ->get();

        return view('concepts.archived', compact('concepts'));
    }

    public function restore(Concept $concept)
    {
        if ($concept->domain->user_id !== auth()->id()) {
            abort(403);
        }

        $concept->restore();

        return redirect()->route('concepts.archived')->with('success', 'Concept restauré.');
    }

    public function forceDelete(Concept $concept)
    {
        if ($concept->domain->user_id !== auth()->id()) {
            abort(403);
        }

        $concept->forceDelete();

        return redirect()->route('concepts.archived')->with('success', 'Concept supprimé définitivement.');
    }
}