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
        <div class="min-h-screen flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-white">InterviewPrep</h1>
                    <p class="text-[#b8d9d5] mt-2">Préparez vos entretiens techniques</p>
                </div>
                <div class="rounded-xl p-8" style="background: #136f63; border: 1px solid rgba(255,255,255,0.08);">
                    {{ $slot }}
                </div>
                <p class="text-center mt-6 text-[#b8d9d5] text-sm">
                    Pas de compte ? <a href="{{ route('register') }}" class="text-[#4ce0d2] hover:underline">Inscrivez-vous</a>
                </p>
            </div>
        </div>
    </body>
</html>