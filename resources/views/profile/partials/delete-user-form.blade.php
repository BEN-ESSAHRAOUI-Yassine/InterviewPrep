<form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
    @csrf
    @method('delete')

    <p class="text-[#b8d9d5] text-sm">
        Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées.
    </p>

    <div>
        <label class="block text-sm font-medium text-[#b8d9d5] mb-2">Mot de passe</label>
        <input type="password" name="password" placeholder="Entrez votre mot de passe" class="w-full px-4 py-3 rounded-xl outline-none transition-all duration-200" style="background: #0c2f28; border: 1px solid #136f63; color: white;" onfocus="this.style.borderColor='#4ce0d2'; this.style.boxShadow='0 0 0 4px rgba(76,224,210,0.15)'" onblur="this.style.borderColor='#136f63'; this.style.boxShadow='none'">
        @error('password', 'userDeletion')
            <p class="mt-2 text-sm text-[#ff7675]">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="px-6 py-3 rounded-xl font-medium transition-all duration-200" style="background: #ff7675; color: white;" onmouseover="this.style.filter='brightness(1.1)'" onmouseout="this.style.filter='brightness(1)'">
        Supprimer le compte
    </button>
</form>