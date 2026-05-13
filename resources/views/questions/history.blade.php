<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="text-[#b8d9d5] hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-white leading-tight">Historique des questions supprimées</h2>
            </div>
        </div>
    </x-slot>

    <div class="px-6">
        @if($deletedQuestions->count() > 0)
            <div class="space-y-4">
                @foreach($deletedQuestions as $question)
                    <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-white font-medium">{{ $question->concept->title }}</span>
                                <span class="text-[#b8d9d5] text-sm ml-2">({{ $question->concept->domain->title }})</span>
                            </div>
                            <span class="text-[#b8d9d5] text-sm">Supprimé le {{ $question->deleted_at->format('d/m/Y à H:i') }}</span>
                        </div>
                        <ul class="list-disc list-inside space-y-1 mb-4">
                            @foreach($question->questions as $q)
                                <li class="text-white text-sm">{{ $q }}</li>
                            @endforeach
                        </ul>
                        <div class="flex gap-3">
                            <form action="{{ route('questions.restore', $question) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 rounded-lg text-sm font-medium bg-[#4ce0d2]/20 text-[#4ce0d2] hover:bg-[#4ce0d2]/30">
                                    Restaurer
                                </button>
                            </form>
                            <form action="{{ route('questions.forceDelete', $question) }}" method="POST" onsubmit="return confirm('Supprimer définitivement ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 rounded-lg text-sm font-medium bg-[#ff7675]/20 text-[#ff7675] hover:bg-[#ff7675]/30">
                                    Supprimer définitivement
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-xl p-6 border text-center" style="background: rgba(19,111,99,0.45); border-color: rgba(255,255,255,0.08);">
                <p class="text-[#b8d9d5]">Aucune question supprimée.</p>
            </div>
        @endif
    </div>
</x-app-layout>