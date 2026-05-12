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
        <div class="min-h-screen flex">
            <aside class="w-64 min-h-screen flex-shrink-0" style="background: #0a2c24;">
                <div class="p-6">
                    <h1 class="text-xl font-bold text-white mb-8">InterviewPrep</h1>
                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 @if(request()->routeIs('dashboard')) text-[#041b15] font-medium @else text-[#b8d9d5] hover:text-white @endif" @if(request()->routeIs('dashboard')) style="background: #22aaa1;" @endif>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Dashboard
                        </a>
                        <a href="{{ route('domains.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 @if(request()->routeIs('domains.*')) text-[#041b15] font-medium @else text-[#b8d9d5] hover:text-white @endif" @if(request()->routeIs('domains.*')) style="background: #22aaa1;" @endif>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            Domaines
                        </a>
                    </nav>
                </div>

                <div class="absolute bottom-0 w-64 p-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#b8d9d5] hover:text-white transition-all duration-200 w-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </aside>

            <main class="flex-1">
                <header class="border-b px-8 py-4" style="border-color: rgba(255,255,255,0.08); background: #041b15;">
                    <div class="flex justify-between items-center">
                        <div>
                            {{ $header }}
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-[#b8d9d5] text-sm">{{ auth()->user()->name }}</span>
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium" style="background: #22aaa1; color: #041b15;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        </div>
                    </div>
                </header>

                <div class="p-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>