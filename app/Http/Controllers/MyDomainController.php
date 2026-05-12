<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;

class MyDomainController extends Controller
{
    public function index()
    {
        $domains = auth()->user()->domains()
            ->withCount([
                'concepts',
                'concepts as mastered_count' => fn($q) => $q->where('status', 'mastered'),
            ])
            ->get();

        return view('domains.my', compact('domains'));
    }
}