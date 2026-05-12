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

    <div class="space-y-6">
        <div class="rounded-xl p-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.08);">
            <h3 class="text-lg font-semibold text-white mb-4">Informations du profil</h3>
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="rounded-xl p-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.08);">
            <h3 class="text-lg font-semibold text-white mb-4">Mettre à jour le mot de passe</h3>
            @include('profile.partials.update-password-form')
        </div>

        <div class="rounded-xl p-6" style="background: rgba(19,111,99,0.45); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.08);">
            <h3 class="text-lg font-semibold text-white mb-4">Supprimer le compte</h3>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>