<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sesi Berakhir | {{ config('app.name', 'E-Modul') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-700 antialiased min-h-screen flex items-center justify-center p-4">
    <div class="fixed inset-0 -z-10 bg-gradient-to-br from-violet-100 via-sky-50 to-emerald-50"></div>
    <div class="fixed -z-10 -top-24 -left-24 w-96 h-96 bg-amber-100/40 rounded-full blur-3xl"></div>
    <div class="fixed -z-10 -bottom-24 -right-24 w-96 h-96 bg-sky-200/40 rounded-full blur-3xl"></div>

    <div class="max-w-md w-full bg-white/70 backdrop-blur-2xl border border-white/60 shadow-xl shadow-indigo-200/20 rounded-3xl p-8 text-center">
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-amber-50 border border-amber-200/60 flex items-center justify-center text-amber-500">
            <x-icon name="jam" class="w-8 h-8" />
        </div>
        <span class="text-xs font-semibold uppercase tracking-wider text-amber-600">Kesalahan 419</span>
        <h1 class="text-2xl font-bold text-slate-800 mt-1 mb-2">Sesi Berakhir</h1>
        <p class="text-sm text-slate-600 mb-6 leading-relaxed">
            Sesi Anda berakhir. Muat ulang halaman lalu coba lagi
        </p>
        <div class="flex justify-center gap-3">
            <button onclick="window.location.reload()" class="inline-flex items-center justify-center px-4 py-2.5 rounded-2xl text-sm font-medium bg-white/80 border border-slate-200 text-slate-700 hover:bg-slate-50 transition-all duration-200">
                Muat Ulang
            </button>
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-2xl text-sm font-medium bg-gradient-to-r from-indigo-500 to-violet-500 text-white shadow-md shadow-indigo-200 hover:from-indigo-600 hover:to-violet-600 transition-all duration-200">
                Kembali
            </a>
        </div>
    </div>
</body>
</html>
