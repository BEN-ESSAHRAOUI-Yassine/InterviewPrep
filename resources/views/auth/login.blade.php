<x-guest-layout>
    @if (session('status'))
        <div class="mb-4 px-4 py-3 rounded-xl text-sm" style="background: rgba(76,224,210,0.15); border: 1px solid #4ce0d2; color: #4ce0d2;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
            @error('email')
                <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Mot de passe</label>
            <input type="password" name="password" required autocomplete="current-password" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
            @error('password')
                <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-[#b8d9d5] text-sm">
                <input type="checkbox" name="remember" class="rounded" style="accent-color: #22aaa1;">
                Se souvenir de moi
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-[#4ce0d2] hover:underline">Mot de passe oublié ?</a>
            @endif
        </div>

        <button type="submit" class="w-full px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
            Se connecter
        </button>
    </form>
</x-guest-layout>