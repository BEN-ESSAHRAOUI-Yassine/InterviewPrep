<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $domains = $user->domains()
            ->withCount([
                'concepts',
                'concepts as to_review_count'   => fn($q) => $q->where('status', 'to_review'),
                'concepts as in_progress_count' => fn($q) => $q->where('status', 'in_progress'),
                'concepts as mastered_count'    => fn($q) => $q->where('status', 'mastered'),
            ])
            ->get();

        $stats = [
            'total'       => $domains->sum('concepts_count'),
            'to_review'   => $domains->sum('to_review_count'),
            'in_progress' => $domains->sum('in_progress_count'),
            'mastered'    => $domains->sum('mastered_count'),
        ];

        $stats['percent'] = $stats['total'] > 0
            ? round(($stats['mastered'] / $stats['total']) * 100)
            : 0;

        $bestDomain = $domains
            ->filter(fn($d) => $d->concepts_count > 0)
            ->sortByDesc(fn($d) => $d->mastered_count / $d->concepts_count)
            ->first();

        $worstDomain = $domains->sortByDesc('to_review_count')->first();

        return view('dashboard', compact('domains', 'stats', 'bestDomain', 'worstDomain'));
    }
}