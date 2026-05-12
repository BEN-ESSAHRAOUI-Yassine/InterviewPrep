<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(request()->routeIs('dashboard')) text-[#041b15] @else text-[#b8d9d5] @endif" @if(request()->routeIs('dashboard')) style="background: #22aaa1;" @else style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" @endif>
                Dashboard
            </a>
            <a href="{{ route('all-domains') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(request()->routeIs('all-domains')) text-[#041b15] @else text-[#b8d9d5] @endif" @if(request()->routeIs('all-domains')) style="background: #22aaa1;" @else style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" @endif>
                Domaines
            </a>
            <a href="{{ route('mes-domaines') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(request()->routeIs('mes-domaines')) text-[#041b15] @else text-[#b8d9d5] @endif" @if(request()->routeIs('mes-domaines')) style="background: #22aaa1;" @else style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" @endif>
                Mes domaines
            </a>
            <a href="{{ route('concepts.archived') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(request()->routeIs('concepts.archived')) text-[#041b15] @else text-[#b8d9d5] @endif" @if(request()->routeIs('concepts.archived')) style="background: #22aaa1;" @else style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" @endif>
                Archivés
            </a>
        </div>
    </x-slot>

    <div class="px-6">
        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded-xl text-sm" style="background: rgba(76,224,210,0.15); border: 1px solid #4ce0d2; color: #4ce0d2;">
                {{ session('success') }}
            </div>
        @endif

        @if($concepts->isEmpty())
            <div class="text-center py-16">
                <div class="inline-block p-6 rounded-2xl mb-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px);">
                    <svg class="w-16 h-16 mx-auto text-[#4ce0d2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-white mb-2">Aucun concept archivé</h3>
                <p class="text-[#b8d9d5]">Les concepts supprimés apparaîtront ici.</p>
            </div>
        @else
            <div class="rounded-xl overflow-hidden border" style="border-color: rgba(255,255,255,0.08);">
                <table class="w-full">
                    <thead style="background: #0d312a;">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Titre</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Domaine</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Difficulté</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-[#84cae7]">Supprimé le</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-[#84cae7]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($concepts as $concept)
                        <tr class="border-t" style="border-color: rgba(255,255,255,0.08); background: #136f63;">
                            <td class="px-6 py-4 text-white font-medium">{{ $concept->title }}</td>
                            <td class="px-6 py-4 text-[#b8d9d5]">{{ $concept->domain->name }}</td>
                            <td class="px-6 py-4">
                                @php $diffColors = ['junior' => 'bg-[#4ce0d2]/20 text-[#4ce0d2]', 'mid' => 'bg-[#84cae7]/20 text-[#84cae7]', 'senior' => 'bg-[#22aaa1]/20 text-[#22aaa1]']; @endphp
                                <span class="px-3 py-1 rounded-lg text-sm font-medium {{ $diffColors[$concept->difficulty] ?? '' }}">
                                    {{ $concept->difficultyLabel }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-[#b8d9d5] text-sm">{{ $concept->deleted_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <form method="POST" action="{{ route('concepts.restore', $concept) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-lg text-sm text-[#4ce0d2] hover:bg-[#4ce0d2] hover:text-[#041b15] transition-all duration-200" style="border: 1px solid #4ce0d2;">
                                            Restaurer
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('concepts.forceDelete', $concept) }}" class="inline" onsubmit="return confirm('Supprimer définitivement ?');">
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