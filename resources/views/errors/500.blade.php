<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f8fafc">
    <title>Terjadi Kendala Server | {{ config('app.name', 'E-Modul') }}</title>

    <!-- Anti-kilatan tema (FOUC) -->
    @include('partials.theme-script')

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-700 dark:text-slate-200 antialiased min-h-screen flex items-center justify-center p-4">
    <div class="fixed inset-0 -z-10 bg-gradient-to-br from-violet-100 via-sky-50 to-emerald-50 dark:from-slate-950 dark:via-indigo-950 dark:to-slate-900"></div>
    <div class="fixed -z-10 -top-24 -left-24 w-96 h-96 bg-rose-100/40 dark:bg-slate-900/20 rounded-full blur-3xl"></div>
    <div class="fixed -z-10 -bottom-24 -right-24 w-96 h-96 bg-violet-200/40 dark:bg-indigo-950/20 rounded-full blur-3xl"></div>

    <div class="max-w-md w-full bg-white/70 dark:bg-slate-900/80 backdrop-blur-2xl border border-white/60 dark:border-white/10 shadow-xl shadow-indigo-200/20 dark:shadow-none rounded-3xl p-8 text-center">
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200/60 dark:border-rose-800/60 flex items-center justify-center text-rose-500 dark:text-rose-400">
            <x-icon name="peringatan" class="w-8 h-8" />
        </div>
        <span class="text-xs font-semibold uppercase tracking-wider text-rose-500 dark:text-rose-400">Kesalahan 500</span>
        <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mt-1 mb-2">Terjadi Kendala pada Server</h1>
        <p class="text-sm text-slate-600 dark:text-slate-300 mb-6 leading-relaxed">
            Sistem sedang mengalami kendala sementara. Tim kami sedang menanganinya. Silakan coba beberapa saat lagi.
        </p>
        <div class="flex justify-center gap-3">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-2xl text-sm font-medium bg-gradient-to-r from-indigo-500 to-violet-500 dark:from-indigo-500 dark:to-violet-600 text-white shadow-md shadow-indigo-200 dark:shadow-none hover:from-indigo-600 hover:to-violet-600 dark:hover:from-indigo-400 dark:hover:to-violet-500 transition-all duration-200">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</body>
</html>
