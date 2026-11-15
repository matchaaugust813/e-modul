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
    <body class="font-sans antialiased text-slate-700 dark:text-slate-200">

        {{-- Latar gradient pastel fixed --}}
        <div class="fixed inset-0 -z-10 bg-gradient-to-br from-violet-100 via-sky-50 to-emerald-50 dark:from-slate-950 dark:via-indigo-950 dark:to-slate-900"></div>

        {{-- Blob dekoratif statis di halaman dalam --}}
        <div class="fixed -z-10 -top-32 -left-32 w-[480px] h-[480px] bg-violet-200/40 dark:bg-indigo-950/20 rounded-full blur-3xl"></div>
        <div class="fixed -z-10 -bottom-32 -right-32 w-[480px] h-[480px] bg-sky-200/40 dark:bg-slate-900/30 rounded-full blur-3xl"></div>
        <div class="fixed -z-10 top-1/2 left-1/2 w-80 h-80 bg-emerald-200/30 dark:bg-indigo-950/15 rounded-full blur-3xl"></div>
        <div class="fixed -z-10 top-1/4 right-1/4 w-64 h-64 bg-rose-100/30 dark:bg-slate-900/20 rounded-full blur-3xl"></div>

        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/50 dark:bg-slate-900/60 backdrop-blur-2xl border-b border-white/60 dark:border-white/10 shadow-sm">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="page-enter">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
