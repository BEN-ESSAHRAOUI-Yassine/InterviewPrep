<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 mb-4">
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
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <h2 class="font-semibold text-xl text-white leading-tight">{{ $domain->name }}</h2>
                <span class="w-4 h-4 rounded-full" style="background: {{ ['blue' => '#3b82f6', 'green' => '#22c55e', 'red' => '#ef4444', 'purple' => '#a855f7', 'orange' => '#f97316', 'yellow' => '#eab308', 'pink' => '#ec4899', 'gray' => '#9ca3af'][$domain->color] ?? '#9ca3af' }};"></span>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('domains.concepts.index', $domain) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                    Voir les concepts
                </a>
                <a href="{{ route('domains.edit', $domain) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200" style="border: 1px solid #22aaa1; color: #4ce0d2;">
                    Modifier
                </a>
            </div>
        </div>
    </x-slot>

    <div class="px-6">
        @if(session('success'))
            <div class="mb-6 px-4 py-3 rounded-xl text-sm" style="background: rgba(76,224,210,0.15); border: 1px solid #4ce0d2; color: #4ce0d2;">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-xl p-6 border mb-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
            <div class="grid grid-cols-3 gap-6 text-center">
                <div>
                    <p class="text-3xl font-bold text-white">{{ $domain->concepts_count }}</p>
                    <p class="text-[#b8d9d5] text-sm">Concepts</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-[#4ce0d2]">{{ $domain->mastered_count }}</p>
                    <p class="text-[#b8d9d5] text-sm">Maîtrisés</p>
                </div>
                <div>
                    @php $percent = $domain->concepts_count > 0 ? round($domain->mastered_count / $domain->concepts_count * 100) : 0; @endphp
                    <p class="text-3xl font-bold text-[#4ce0d2]">{{ $percent }}%</p>
                    <p class="text-[#b8d9d5] text-sm">Progression</p>
                </div>
            </div>
            <div class="mt-4 w-full rounded-full h-3" style="background: #0c2f28;">
                <div class="h-3 rounded-full transition-all duration-300" style="width: {{ $percent }}%; background: #4ce0d2;"></div>
            </div>
        </div>

        @if($domain->concepts_count > 0)
            <div class="mb-6">
                <a href="{{ route('domains.concepts.index', $domain) }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl font-medium transition-all duration-200" style="background: #136f63; color: #4ce0d2; border: 1px solid rgba(255,255,255,0.08);" onmouseover="this.style.background='#22aaa1'; this.style.color='#041b15'" onmouseout="this.style.background='#136f63'; this.style.color='#4ce0d2'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Voir les {{ $domain->concepts_count }} concepts
                </a>
            </div>
        @endif
    </div>
</x-app-layout>