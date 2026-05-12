<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">Vos domaines</h2>
            <a href="{{ route('domains.create') }}" class="px-5 py-2.5 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                + Nouveau domaine
            </a>
        </div>
    </x-slot>

    <div class="px-6">
        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded-xl text-sm" style="background: rgba(76,224,210,0.15); border: 1px solid #4ce0d2; color: #4ce0d2;">
                {{ session('success') }}
            </div>
        @endif

        @if($domains->isEmpty())
            <div class="text-center py-16">
                <div class="inline-block p-6 rounded-2xl mb-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px);">
                    <svg class="w-16 h-16 mx-auto text-[#4ce0d2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-semibold text-white mb-2">Aucun domaine</h3>
                <p class="text-[#b8d9d5] mb-6">Créez votre premier domaine pour organiser vos concepts</p>
                <a href="{{ route('domains.create') }}" class="inline-block px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                    Créer un domaine
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($domains as $domain)
                <a href="{{ route('domains.show', $domain) }}" class="block rounded-xl p-6 border transition-all duration-200 hover:-translate-y-1" style="background: #136f63; border-color: rgba(255,255,255,0.08); box-shadow: 0 8px 32px rgba(0,0,0,0.25);">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-white font-semibold text-lg">{{ $domain->name }}</h3>
                        <span class="px-3 py-1 rounded-lg text-sm font-medium bg-{{ $domain->color }}-100 text-{{ $domain->color }}-800">
                            {{ ucfirst($domain->color) }}
                        </span>
                    </div>
                    <div class="flex justify-between text-sm mb-4">
                        <span class="text-[#b8d9d5]">{{ $domain->concepts_count }} concepts</span>
                        <span class="text-[#4ce0d2]">{{ $domain->mastered_count }} maîtrisés</span>
                    </div>
                    <div class="w-full rounded-full h-2 mb-4" style="background: #0c2f28;">
                        @php $percent = $domain->concepts_count > 0 ? round($domain->mastered_count / $domain->concepts_count * 100) : 0; @endphp
                        <div class="h-2 rounded-full transition-all duration-300" style="width: {{ $percent }}%; background: #4ce0d2;"></div>
                    </div>
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('domains.edit', $domain) }}" class="px-3 py-1.5 rounded-lg text-sm text-[#4ce0d2] hover:bg-[#4ce0d2] hover:text-[#041b15] transition-all duration-200" style="border: 1px solid #4ce0d2;">
                            Modifier
                        </a>
                        <form method="POST" action="{{ route('domains.destroy', $domain) }}" class="inline" onsubmit="return confirm('Supprimer ce domaine et tous ses concepts ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 rounded-lg text-sm text-[#ff7675] hover:bg-[#ff7675] hover:text-white transition-all duration-200" style="border: 1px solid #ff7675;">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>