<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#f8fafc">

        <title>@hasSection('title')@yield('title') | @elseif(isset($title)){{ $title }} | @endif{{ config('app.name', 'E-Modul') }}</title>

        <!-- Anti-kilatan tema (FOUC) -->
        @include('partials.theme-script')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-700 dark:text-slate-200 antialiased">

        {{-- Latar gradient pastel fixed --}}
        <div class="fixed inset-0 -z-10 bg-gradient-to-br from-violet-100 via-sky-50 to-emerald-50 dark:from-slate-950 dark:via-indigo-950 dark:to-slate-900"></div>

        {{-- Blob dekoratif statis --}}
        <div class="fixed -z-10 -top-24 -left-24 w-[400px] h-[400px] bg-violet-200/50 dark:bg-indigo-950/20 rounded-full blur-3xl"></div>
        <div class="fixed -z-10 -bottom-24 -right-24 w-[400px] h-[400px] bg-sky-200/50 dark:bg-slate-900/30 rounded-full blur-3xl"></div>
        <div class="fixed -z-10 top-1/2 right-1/3 w-56 h-56 bg-rose-100/40 dark:bg-slate-900/20 rounded-full blur-3xl"></div>

        {{-- Tombol pengalih tema di pojok atas --}}
        <div class="absolute top-4 right-4 sm:top-6 sm:right-6 z-20">
            <x-theme-toggle />
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 page-enter">

            <!-- Brand logo + nama -->
            <div class="mb-6 flex flex-col items-center gap-2">
                <a href="/">
                    <x-application-logo class="w-16 h-16 drop-shadow-md" />
                </a>
                <span class="text-xl font-semibold text-slate-700 dark:text-slate-100 tracking-tight">E-Modul</span>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 bg-white/50 dark:bg-slate-900/60 backdrop-blur-2xl border border-white/60 dark:border-white/10 shadow-xl shadow-indigo-200/30 dark:shadow-none rounded-3xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
