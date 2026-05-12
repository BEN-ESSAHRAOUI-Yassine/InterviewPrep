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
            <a href="#" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200" style="background: #136f63; color: #b8d9d5; border: 1px solid rgba(255,255,255,0.1);">
                Archivés
            </a>
        </div>
    </x-slot>

    <div class="py-8 px-6">
        <div class="max-w-7xl mx-auto space-y-8">
            @if($domains->isEmpty())
                <div class="text-center py-16">
                    <div class="inline-block p-6 rounded-2xl mb-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px);">
                        <svg class="w-16 h-16 mx-auto text-[#4ce0d2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-2">Commencez votre préparation</h3>
                    <p class="text-[#b8d9d5] mb-6">Créez votre premier domaine pour suivre votre progression</p>
                    <a href="{{ route('domains.create') }}" class="inline-block px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                        Créer un domaine
                    </a>
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                    <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
                        <p class="text-[#84cae7] text-sm mb-2">Total Concepts</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['total'] }}</p>
                    </div>
                    <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
                        <p class="text-[#ff7675] text-sm mb-2">À revoir</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['to_review'] }}</p>
                    </div>
                    <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
                        <p class="text-[#ffeaa7] text-sm mb-2">En cours</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['in_progress'] }}</p>
                    </div>
                    <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
                        <p class="text-[#4ce0d2] text-sm mb-2">Maîtrisés</p>
                        <p class="text-3xl font-bold text-white">{{ $stats['mastered'] }}</p>
                    </div>
                </div>

                <div class="rounded-xl p-6 border" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border-color: rgba(255,255,255,0.08);">
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-[#b8d9d5]">Progression globale</span>
                        <span class="text-white font-semibold">{{ $stats['percent'] }}%</span>
                    </div>
                    <div class="w-full rounded-full h-3" style="background: #0c2f28;">
                        <div class="h-3 rounded-full transition-all duration-300" style="width: {{ $stats['percent'] }}%; background: #4ce0d2;"></div>
                    </div>
                </div>

                @if($bestDomain || $worstDomain)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @if($bestDomain)
                    <div class="rounded-xl p-6 border" style="background: #136f63; border-color: rgba(255,255,255,0.08);">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-2xl">🏆</span>
                            <span class="text-[#4ce0d2] font-semibold">Domaine le mieux maîtrisé</span>
                        </div>
                        <p class="text-white text-lg font-medium">{{ $bestDomain->name }}</p>
                        <p class="text-[#b8d9d5] text-sm">{{ round($bestDomain->mastered_count / $bestDomain->concepts_count * 100) }}% maîtrisé ({{ $bestDomain->mastered_count }}/{{ $bestDomain->concepts_count }})</p>
                    </div>
                    @endif
                    @if($worstDomain && $worstDomain->to_review_count > 0)
                    <div class="rounded-xl p-6 border" style="background: #136f63; border-color: rgba(255,255,255,0.08);">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-2xl">⚠️</span>
                            <span class="text-[#ff7675] font-semibold">Domaine prioritaire</span>
                        </div>
                        <p class="text-white text-lg font-medium">{{ $worstDomain->name }}</p>
                        <p class="text-[#b8d9d5] text-sm">{{ $worstDomain->to_review_count }} concepts à revoir</p>
                    </div>
                    @endif
                </div>
                @endif

                <div>
                    <h3 class="text-xl font-semibold text-white mb-4">Vos domaines</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach($domains as $domain)
                        <a href="{{ route('domains.show', $domain) }}" class="block rounded-xl p-6 border transition-all duration-200 hover:-translate-y-1" style="background: #136f63; border-color: rgba(255,255,255,0.08); box-shadow: 0 8px 32px rgba(0,0,0,0.25);">
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="text-white font-semibold text-lg">{{ $domain->name }}</h4>
                                <span class="text-[#84cae7] text-sm">{{ $domain->concepts_count }} concepts</span>
                            </div>
                            <div class="w-full rounded-full h-2 mb-3" style="background: #0c2f28;">
                                @php $percent = $domain->concepts_count > 0 ? round($domain->mastered_count / $domain->concepts_count * 100) : 0; @endphp
                                <div class="h-2 rounded-full transition-all duration-300" style="width: {{ $percent }}%; background: #4ce0d2;"></div>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-[#ff7675]">{{ $domain->to_review_count }} à revoir</span>
                                <span class="text-[#4ce0d2]">{{ $percent }}%</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>