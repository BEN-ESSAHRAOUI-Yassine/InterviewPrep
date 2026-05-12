<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'InterviewPrep') }}</title>

        <link rel="preconnect" href="https://fonts.bstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background: #041b15; font-family: 'Inter', sans-serif;">
        <div class="min-h-screen">
            <header class="px-6 py-4 flex justify-between items-center" style="background: #0a2c24;">
                <h1 class="text-xl font-bold text-white mr-8">InterviewPrep</h1>
                <nav class="flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(request()->routeIs('dashboard')) text-[#041b15] @else text-[#b8d9d5] hover:text-white @endif" @if(request()->routeIs('dashboard')) style="background: #22aaa1;" @else style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" @endif>
                        Dashboard
                    </a>
                    <a href="{{ route('all-domains') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(request()->routeIs('all-domains')) text-[#041b15] @else text-[#b8d9d5] hover:text-white @endif" @if(request()->routeIs('all-domains')) style="background: #22aaa1;" @else style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" @endif>
                        Domaines
                    </a>
                    <a href="{{ route('mes-domaines') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(request()->routeIs('mes-domaines')) text-[#041b15] @else text-[#b8d9d5] hover:text-white @endif" @if(request()->routeIs('mes-domaines')) style="background: #22aaa1;" @else style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" @endif>
                        Mes domaines
                    </a>
                    <a href="{{ route('concepts.archived') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 @if(request()->routeIs('concepts.archived')) text-[#041b15] @else text-[#b8d9d5] hover:text-white @endif" @if(request()->routeIs('concepts.archived')) style="background: #22aaa1;" @else style="background: #136f63; border: 1px solid rgba(255,255,255,0.1);" @endif>
                        Archivés
                    </a>
                </nav>
                <div class="flex items-center gap-3">
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200" style="border: 1px solid rgba(255,255,255,0.1); color: #b8d9d5;">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200" style="background: #ff7675; color: white;">
                            Déconnexion
                        </button>
                    </form>
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium" style="background: #22aaa1; color: #041b15;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <div class="p-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>