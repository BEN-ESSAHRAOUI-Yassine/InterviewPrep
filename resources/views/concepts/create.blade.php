<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('domains.concepts.index', $domain) }}" class="text-[#b8d9d5] hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-white leading-tight">Nouveau concept</h2>
            <span class="px-3 py-1 rounded-lg text-sm font-medium bg-{{ $domain->color }}-100 text-{{ $domain->color }}-800">
                {{ $domain->name }}
            </span>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6">
        <form method="POST" action="{{ route('domains.concepts.store', $domain) }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Titre du concept</label>
                <input type="text" name="title" value="{{ old('title') }}" required maxlength="200" placeholder="Ex: Eloquent N+1 Problem" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
                @error('title')
                    <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Explication</label>
                <textarea name="explanation" rows="8" required minlength="20" placeholder="Expliquez le concept en détail..." class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200 resize-none" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">{{ old('explanation') }}</textarea>
                @error('explanation')
                    <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Difficulté</label>
                <div class="grid grid-cols-3 gap-3">
                    @foreach(['junior', 'mid', 'senior'] as $diff)
                    <label class="cursor-pointer">
                        <input type="radio" name="difficulty" value="{{ $diff }}" @checked(old('difficulty', 'junior') === $diff) class="sr-only peer">
                        @php $diffColors = ['junior' => ['bg' => 'bg-[#4ce0d2]/10', 'text' => 'text-[#4ce0d2]', 'ring' => 'ring-[#4ce0d2]'], 'mid' => ['bg' => 'bg-[#84cae7]/10', 'text' => 'text-[#84cae7]', 'ring' => 'ring-[#84cae7]'], 'senior' => ['bg' => 'bg-[#22aaa1]/10', 'text' => 'text-[#22aaa1]', 'ring' => 'ring-[#22aaa1]']]; @endphp
                        <div class="px-4 py-3 rounded-xl text-center text-sm font-medium transition-all duration-200 peer-checked:ring-2 {{ $diffColors[$diff]['ring'] }} {{ $diffColors[$diff]['bg'] }} {{ $diffColors[$diff]['text'] }}" style="border: 1px solid currentColor;">
                            {{ ucfirst($diff) }}
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('difficulty')
                    <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                    Créer le concept
                </button>
                <a href="{{ route('domains.concepts.index', $domain) }}" class="px-6 py-3 rounded-xl font-medium transition-all duration-200" style="border: 1px solid #22aaa1; color: #4ce0d2;">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-app-layout>