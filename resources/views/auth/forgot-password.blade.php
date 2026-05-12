<x-guest-layout>
    <p class="text-[#b8d9d5] text-sm mb-6">
        Mot de passe oublié ? Aucun problème. Entrez votre adresse email et nous vous enverrons un lien de réinitialisation.
    </p>

    @if (session('status'))
        <div class="mb-4 px-4 py-3 rounded-xl text-sm" style="background: rgba(76,224,210,0.15); border: 1px solid #4ce0d2; color: #4ce0d2;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
            @error('email')
                <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
            Envoyer le lien
        </button>
    </form>
</x-guest-layout>