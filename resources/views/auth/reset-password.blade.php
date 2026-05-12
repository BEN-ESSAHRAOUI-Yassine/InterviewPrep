<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
            @error('email')
                <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Nouveau mot de passe</label>
            <input type="password" name="password" required autocomplete="new-password" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
            @error('password')
                <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required autocomplete="new-password" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
            @error('password_confirmation')
                <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
            Réinitialiser le mot de passe
        </button>
    </form>
</x-guest-layout>