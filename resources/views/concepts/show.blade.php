<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <a href="{{ route('domains.concepts.index', $domain) }}" class="text-[#b8d9d5] hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-white leading-tight">{{ $concept->title }}</h2>
                @php $diffColors = ['junior' => 'bg-[#4ce0d2]/20 text-[#4ce0d2]', 'mid' => 'bg-[#84cae7]/20 text-[#84cae7]', 'senior' => 'bg-[#22aaa1]/20 text-[#22aaa1]']; @endphp
                <span class="px-3 py-1 rounded-lg text-sm font-medium {{ $diffColors[$concept->difficulty] ?? '' }}">
                    {{ $concept->difficultyLabel }}
                </span>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('domains.concepts.edit', [$domain, $concept]) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200" style="border: 1px solid #22aaa1; color: #4ce0d2;">
                    Modifier
                </a>
            </div>
        </div>
    </x-slot>

    <div class="px-6 space-y-6">
        <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
            <div class="flex items-center gap-4 mb-4">
                <span class="px-4 py-2 rounded-xl text-sm font-medium @if($concept->status === 'to_review') bg-[#ff7675]/20 text-[#ff7675] @elseif($concept->status === 'in_progress') bg-[#ffeaa7]/20 text-[#ffeaa7] @else bg-[#4ce0d2]/20 text-[#4ce0d2] @endif">
                    {{ $concept->statusLabel }}
                </span>
                <form method="POST" action="{{ route('concepts.updateStatus', $concept) }}" class="flex items-center gap-2">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()" class="text-sm rounded-lg px-3 py-2 cursor-pointer outline-none" style="background: #0c2f28; border: 1px solid #136f63; color: white;">
                        <option value="to_review" @selected($concept->status === 'to_review')>À revoir</option>
                        <option value="in_progress" @selected($concept->status === 'in_progress')>En cours</option>
                        <option value="mastered" @selected($concept->status === 'mastered')>Maîtrisé</option>
                    </select>
                </form>
            </div>

            <h3 class="text-lg font-semibold text-white mb-3">Explication</h3>
            <div class="prose prose-invert max-w-none text-[#b8d9d5] whitespace-pre-wrap">{{ $concept->explanation }}</div>
        </div>

        <div class="rounded-xl p-6 border" style="background: #136f63; border-color: rgba(255,255,255,0.08);">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Questions générées</h3>
                <form action="{{ route('questions.store', [$domain, $concept]) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 flex items-center gap-2" style="background: linear-gradient(135deg, #136f63, #22aaa1); color: #041b15;" onmouseover="this.style.filter='brightness(1.08)'" onmouseout="this.style.filter='brightness(1)'">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Générer des questions
                    </button>
                </form>
            </div>
            @if($concept->generatedQuestions->count() > 0)
                <div class="space-y-4">
                    @foreach($concept->generatedQuestions()->latest()->get() as $generation)
                        <div class="rounded-lg p-4" style="background: rgba(0,0,0,0.2);">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm text-[#b8d9d5]">
                                    Génération du {{ $generation->created_at->format('d/m/Y à H:i') }}
                                </span>
                                <form action="{{ route('questions.destroy', $generation) }}" method="POST" onsubmit="return confirm('Supprimer ce lot de questions ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[#ff7675] hover:text-[#ff7675]/80 text-sm font-medium">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                            <ol class="list-decimal list-inside space-y-1">
                                @foreach($generation->questions as $question)
                                    <li class="text-white text-sm">{{ $question }}</li>
                                @endforeach
                            </ol>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-[#b8d9d5] text-sm">Les questions d'entretien pour ce concept apparaîtront ici.</p>
            @endif
        </div>
    </div>
</x-app-layout>