<form method="post" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('put')

    <div>
        <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Mot de passe actuel</label>
        <input type="password" name="current_password" autocomplete="current-password" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
        @error('current_password', 'updatePassword')
            <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Nouveau mot de passe</label>
        <input type="password" name="password" autocomplete="new-password" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
        @error('password', 'updatePassword')
            <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Confirmer le mot de passe</label>
        <input type="password" name="password_confirmation" autocomplete="new-password" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
        @error('password_confirmation', 'updatePassword')
            <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-4 pt-2">
        <button type="submit" class="px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #22aaa1; color: #041b15;" onmouseover="this.style.background='#4ce0d2'" onmouseout="this.style.background='#22aaa1'">
            Mettre à jour
        </button>
        @if (session('status') === 'password-updated')
            <p class="text-sm text-[#4ce0d2]">Mis à jour.</p>
        @endif
    </div>
</form>