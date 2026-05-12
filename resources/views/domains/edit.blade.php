<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Modifier le domaine</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6">
        <form method="POST" action="{{ route('domains.update', $domain) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Nom du domaine</label>
                <input type="text" name="name" value="{{ old('name', $domain->name) }}" required maxlength="100" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
                @error('name')
                    <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Couleur</label>
                <div class="grid grid-cols-4 gap-3">
                    @foreach(['blue', 'green', 'red', 'purple', 'orange', 'yellow', 'pink', 'gray'] as $color)
                    <label class="cursor-pointer">
                        <input type="radio" name="color" value="{{ $color }}" @checked(old('color', $domain->color) === $color) class="sr-only peer">
                        <div class="px-4 py-3 rounded-xl text-center text-sm font-medium transition-all duration-200 peer-checked:ring-2 peer-checked:ring-[#4ce0d2] bg-{{ $color }}-100 text-{{ $color }}-800 hover:bg-{{ $color }}-200">
                            {{ ucfirst($color) }}
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('color')
                    <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
                    Enregistrer
                </button>
                <a href="{{ route('domains.index') }}" class="px-6 py-3 rounded-xl font-medium transition-all duration-200" style="border: 1px solid #22aaa1; color: #4ce0d2;">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-app-layout>