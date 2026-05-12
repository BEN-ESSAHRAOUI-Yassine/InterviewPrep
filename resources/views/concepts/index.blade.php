<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <a href="{{ route('domains.index') }}" class="text-[#b8d9d5] hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-white leading-tight">{{ $domain->name }}</h2>
                <span class="px-3 py-1 rounded-lg text-sm font-medium bg-{{ $domain->color }}-100 text-{{ $domain->color }}-800">
                    {{ $domain->concepts_count }} concepts
                </span>
            </div>
            <a href="{{ route('domains.concepts.create', $domain) }}" class="px-5 py-2.5 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                + Nouveau concept
            </a>
        </div>
    </x-slot>

    <div class="px-6">
        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded-xl text-sm" style="background: rgba(76,224,210,0.15); border: 1px solid #4ce0d2; color: #4ce0d2;">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex gap-2 mb-6">
            <a href="{{ route('domains.concepts.index', $domain) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(!request('status')) text-[#041b15] @endif" style="@if(!request('status')) background: #22aaa1; @else color: #b8d9d5; @endif">
                Tous
            </a>
            <a href="{{ route('domains.concepts.index', $domain) }}?status=to_review" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(request('status') === 'to_review') text-[#041b15] @endif" style="@if(request('status') === 'to_review') background: #ff7675; @else color: #b8d9d5; @endif">
                À revoir
            </a>
            <a href="{{ route('domains.concepts.index', $domain) }}?status=in_progress" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(request('status') === 'in_progress') text-[#041b15] @endif" style="@if(request('status') === 'in_progress') background: #ffeaa7; @else color: #b8d9d5; @endif">
                En cours
            </a>
            <a href="{{ route('domains.concepts.index', $domain) }}?status=mastered" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(request('status') === 'mastered') text-[#041b15] @endif" style="@if(request('status') === 'mastered') background: #4ce0d2; @else color: #b8d9d5; @endif">
                Maîtrisés
            </a>
        </div>

        @if($concepts->isEmpty())
            <div class="text-center py-16">
                <div class="inline-block p-6 rounded-2xl mb-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px);">
                    <svg class="w-16 h-16 mx-auto text-[#4ce0d2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-white mb-2">Aucun concept</h3>
                <p class="text-[#b8d9d5] mb-6">Créez votre premier concept dans ce domaine</p>
                <a href="{{ route('domains.concepts.create', $domain) }}" class="inline-block px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                    Créer un concept
                </a>
            </div>
        @else
            <div class="rounded-xl overflow-hidden border" style="border-color: rgba(255,255,255,0.08);">
                <table class="w-full">
                    <thead style="background: #0d312a;">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Titre</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Difficulté</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Statut</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-[#84cae7]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($concepts as $concept)
                        <tr class="border-t" style="border-color: rgba(255,255,255,0.08); background: #136f63;">
                            <td class="px-6 py-4">
                                <a href="{{ route('domains.concepts.show', [$domain, $concept]) }}" class="text-white font-medium hover:text-[#4ce0d2] transition-colors">
                                    {{ $concept->title }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                @php $diffColors = ['junior' => 'bg-[#4ce0d2]/20 text-[#4ce0d2]', 'mid' => 'bg-[#84cae7]/20 text-[#84cae7]', 'senior' => 'bg-[#22aaa1]/20 text-[#22aaa1]']; @endphp
                                <span class="px-3 py-1 rounded-lg text-sm font-medium {{ $diffColors[$concept->difficulty] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $concept->difficultyLabel }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('concepts.updateStatus', $concept) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="text-sm rounded-lg px-3 py-1 cursor-pointer outline-none" style="background: #0c2f28; border: 1px solid #136f63; color: white;">
                                        <option value="to_review" @selected($concept->status === 'to_review') class="bg-[#0c2f28]">À revoir</option>
                                        <option value="in_progress" @selected($concept->status === 'in_progress') class="bg-[#0c2f28]">En cours</option>
                                        <option value="mastered" @selected($concept->status === 'mastered') class="bg-[#0c2f28]">Maîtrisé</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('domains.concepts.show', [$domain, $concept]) }}" class="px-3 py-1.5 rounded-lg text-sm text-[#84cae7] hover:bg-[#84cae7] hover:text-[#041b15] transition-all duration-200">
                                        Voir
                                    </a>
                                    <a href="{{ route('domains.concepts.edit', [$domain, $concept]) }}" class="px-3 py-1.5 rounded-lg text-sm text-[#4ce0d2] hover:bg-[#4ce0d2] hover:text-[#041b15] transition-all duration-200" style="border: 1px solid #4ce0d2;">
                                        Modifier
                                    </a>
                                    <form method="POST" action="{{ route('domains.concepts.destroy', [$domain, $concept]) }}" class="inline" onsubmit="return confirm('Supprimer ce concept ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 rounded-lg text-sm text-[#ff7675] hover:bg-[#ff7675] hover:text-white transition-all duration-200" style="border: 1px solid #ff7675;">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>