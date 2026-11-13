<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Portal modul pembelajaran digital untuk siswa dan guru kelas 1 SD sampai 12 SMA.">

        <title>Beranda | E-Modul</title>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-700 selection:bg-indigo-100 selection:text-indigo-700">

        {{-- Latar gradient pastel fixed --}}
        <div class="fixed inset-0 -z-10 bg-gradient-to-br from-violet-100 via-sky-50 to-emerald-50"></div>

        {{-- 4 Blob blur dekoratif bergerak pelan --}}
        <div class="blob-1 fixed -z-10 -top-32 -left-32 w-[480px] h-[480px] bg-violet-200/40 rounded-full blur-3xl pointer-events-none"></div>
        <div class="blob-2 fixed -z-10 -bottom-32 -right-32 w-[480px] h-[480px] bg-sky-200/40 rounded-full blur-3xl pointer-events-none"></div>
        <div class="blob-3 fixed -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-emerald-200/30 rounded-full blur-3xl pointer-events-none"></div>
        <div class="blob-4 fixed -z-10 top-1/4 right-1/4 w-64 h-64 bg-rose-100/30 rounded-full blur-3xl pointer-events-none"></div>

        <div class="min-h-screen flex flex-col justify-between page-enter">

            {{-- 1. Navbar Kaca Sticky --}}
            <nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/50 backdrop-blur-2xl border-b border-white/60 shadow-sm supports-[backdrop-filter]:bg-white/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <!-- Brand Logo + Nama -->
                        <div class="flex items-center gap-3">
                            <a href="/" class="flex items-center gap-2.5 group">
                                <x-application-logo class="w-9 h-9 transition duration-300 group-hover:scale-105" />
                                <span class="font-bold text-slate-800 text-lg tracking-tight">E-Modul</span>
                            </a>
                        </div>

                        <!-- Menu Desktop -->
                        <div class="hidden md:flex items-center gap-8">
                            <a href="#fitur" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition duration-300">Fitur</a>
                            <a href="#cara-kerja" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition duration-300">Cara Kerja</a>
                            <a href="#tentang" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition duration-300">Tentang</a>
                        </div>

                        <!-- Tombol Autentikasi Desktop -->
                        <div class="hidden md:flex items-center gap-3">
                            @auth
                                <a href="{{ auth()->user()->isSuperAdmin() ? route('admin.dashboard') : (auth()->user()->role === 'guru' ? route('guru.dashboard') : route('siswa.dashboard')) }}"
                                   class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-violet-500 rounded-2xl hover:from-indigo-600 hover:to-violet-600 hover:-translate-y-0.5 transition duration-300 ease-out shadow-md shadow-indigo-200/50">
                                    Ke Dashboard &rarr;
                                </a>
                            @else
                                <a href="{{ route('siswa.login') }}"
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white/50 border border-white/70 rounded-2xl hover:bg-white/80 hover:-translate-y-0.5 transition duration-300 ease-out shadow-sm">
                                    Masuk sebagai Siswa
                                </a>
                                <a href="{{ route('guru.login') }}"
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white/50 border border-white/70 rounded-2xl hover:bg-white/80 hover:-translate-y-0.5 transition duration-300 ease-out shadow-sm">
                                    Masuk sebagai Guru
                                </a>
                                <a href="{{ route('login') }}"
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-indigo-400 to-violet-400 rounded-2xl hover:from-indigo-500 hover:to-violet-500 hover:-translate-y-0.5 transition duration-300 ease-out shadow-md shadow-indigo-200/50">
                                    Daftar
                                </a>
                            @endauth
                        </div>

                        <!-- Hamburger Button (Mobile) -->
                        <div class="flex md:hidden">
                            <button @click="open = !open"
                                    type="button"
                                    aria-label="Toggle navigation menu"
                                    class="p-2 rounded-2xl bg-white/50 border border-white/60 text-slate-600 hover:text-slate-900 focus:outline-none transition duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Menu Dropdown Mobile -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="md:hidden border-t border-white/40 bg-white/70 backdrop-blur-2xl px-4 pt-3 pb-5 space-y-3">
                    <a @click="open = false" href="#fitur" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-white/60 transition">Fitur</a>
                    <a @click="open = false" href="#cara-kerja" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-white/60 transition">Cara Kerja</a>
                    <a @click="open = false" href="#tentang" class="block px-3 py-2 rounded-xl text-base font-medium text-slate-700 hover:bg-white/60 transition">Tentang</a>
                    
                    <div class="pt-3 border-t border-white/50 flex flex-col gap-2">
                        @auth
                            <a href="{{ auth()->user()->isSuperAdmin() ? route('admin.dashboard') : (auth()->user()->role === 'guru' ? route('guru.dashboard') : route('siswa.dashboard')) }}"
                               class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-violet-500 shadow-md shadow-indigo-200/50">
                                Ke Dashboard &rarr;
                            </a>
                        @else
                            <a href="{{ route('siswa.login') }}"
                               class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-medium text-slate-700 bg-white/60 border border-white/70 shadow-sm">
                                Masuk sebagai Siswa
                            </a>
                            <a href="{{ route('guru.login') }}"
                               class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-medium text-slate-700 bg-white/60 border border-white/70 shadow-sm">
                                Masuk sebagai Guru
                            </a>
                            <a href="{{ route('login') }}"
                               class="w-full text-center py-2.5 px-4 rounded-2xl text-sm font-medium text-white bg-gradient-to-r from-indigo-400 to-violet-400 shadow-md shadow-indigo-200/50">
                                Daftar Akun Baru
                            </a>
                        @endauth
                    </div>
                </div>
            </nav>

            {{-- Main Content --}}
            <main>
                {{-- 2. Hero Section --}}
                <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-16 sm:pt-20 sm:pb-24">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                        <!-- Teks Hero Kiri -->
                        <div class="lg:col-span-7 text-center lg:text-left">
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/60 backdrop-blur border border-white/80 shadow-sm shadow-indigo-200/30 text-xs font-medium text-indigo-600 mb-6">
                                <span class="flex h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></span>
                                Platform Modul Digital Siswa & Guru
                            </div>

                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-800 tracking-tight leading-[1.15]">
                                Belajar lebih mudah dengan <span class="bg-gradient-to-r from-indigo-500 via-violet-500 to-sky-500 bg-clip-text text-transparent">modul digital</span>
                            </h1>

                            <p class="mt-5 text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                                Akses materi belajar terstruktur dari jenjang SD hingga SMA secara praktis, baca langsung di browser, atau unduh modul kapan pun kamu butuhkan.
                            </p>

                            <!-- Tombol Aksi Hero -->
                            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                                @auth
                                    <a href="{{ auth()->user()->role === 'guru' ? route('guru.dashboard') : route('siswa.dashboard') }}"
                                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-indigo-400 to-violet-400 border border-transparent rounded-2xl font-semibold text-white shadow-lg shadow-indigo-200/50 hover:from-indigo-500 hover:to-violet-500 hover:-translate-y-0.5 transition duration-300 ease-out">
                                        <span>Buka Dashboard</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-indigo-400 to-violet-400 border border-transparent rounded-2xl font-semibold text-white shadow-lg shadow-indigo-200/50 hover:from-indigo-500 hover:to-violet-500 hover:-translate-y-0.5 transition duration-300 ease-out">
                                        <span>Mulai Belajar</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </a>
                                    <a href="{{ route('guru.login') }}"
                                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-white/50 border border-white/70 rounded-2xl font-semibold text-slate-700 hover:bg-white/80 hover:-translate-y-0.5 backdrop-blur shadow-sm transition duration-300 ease-out">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        <span>Masuk sebagai Guru</span>
                                    </a>
                                @endauth
                            </div>
                        </div>

                        <!-- Ilustrasi Dekoratif Kanan (SVG & Glassmorphism) -->
                        <div class="lg:col-span-5 relative flex justify-center">
                            {{-- Cahaya aura latar --}}
                            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-200/40 via-sky-200/30 to-rose-200/30 rounded-3xl blur-2xl -z-10"></div>

                            <div class="relative w-full max-w-sm sm:max-w-md py-6">
                                {{-- Kartu Belakang (Miring melayang) --}}
                                <div class="float-reverse absolute -top-1 left-2 sm:-left-3 w-64 sm:w-72 p-5 bg-white/40 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-lg shadow-indigo-200/20 -z-0">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                                            <x-icon name="buku" class="w-5 h-5" />
                                        </div>
                                        <div>
                                            <div class="h-3 w-28 bg-emerald-300/40 rounded-full"></div>
                                            <div class="h-2 w-16 bg-slate-300/50 rounded-full mt-2"></div>
                                        </div>
                                    </div>
                                    <div class="mt-4 space-y-2">
                                        <div class="h-2 bg-slate-200/70 rounded-full w-full"></div>
                                        <div class="h-2 bg-slate-200/70 rounded-full w-5/6"></div>
                                    </div>
                                </div>

                                {{-- Kartu Depan Utama (Glass Card Interaktif) --}}
                                <div class="float-slow relative ml-auto w-72 sm:w-80 p-6 bg-white/80 border border-slate-200/80 rounded-3xl shadow-xl shadow-indigo-200/20 z-10">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-inner">
                                                <x-icon name="buku" class="w-6 h-6" />
                                            </div>
                                            <div>
                                                <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-indigo-50 border border-indigo-200/70 text-indigo-600">Kelas 10 SMA</span>
                                                <h4 class="text-sm font-bold text-slate-800 mt-1">Fisika Terapan</h4>
                                            </div>
                                        </div>
                                        <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-lg border border-emerald-200/60">PDF</span>
                                    </div>

                                    <div class="mt-4 pt-4 border-t border-slate-100 space-y-2">
                                        <div class="flex justify-between text-xs text-slate-500">
                                            <span>Ukuran Berkas</span>
                                            <span class="font-medium text-slate-700">3,8 MB</span>
                                        </div>
                                        <div class="flex justify-between text-xs text-slate-500">
                                            <span>Materi Bab</span>
                                            <span class="font-medium text-slate-700">Hukum Gerak dan Energi</span>
                                        </div>
                                    </div>

                                    <div class="mt-5 flex gap-2">
                                        <div class="flex-1 py-2 text-center text-xs font-semibold text-white bg-gradient-to-r from-indigo-500 to-violet-500 rounded-xl shadow-sm">
                                            Baca Modul
                                        </div>
                                        <div class="py-2 px-3 flex items-center justify-center text-xs font-medium text-slate-600 bg-white border border-slate-200 rounded-xl shadow-sm">
                                            <x-icon name="unduh" class="w-3.5 h-3.5 text-slate-600" />
                                        </div>
                                    </div>
                                </div>

                                {{-- Floating Badge Kecil --}}
                                <div class="float-reverse absolute -bottom-4 left-6 sm:left-4 px-4 py-2.5 bg-white/80 border border-slate-200/80 rounded-2xl shadow-lg shadow-sky-200/20 flex items-center gap-2.5 z-20">
                                    <div class="w-7 h-7 rounded-full bg-sky-100 flex items-center justify-center text-sky-600">
                                        <x-icon name="centang" class="w-4 h-4" />
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800">Privat dan Aman</p>
                                        <p class="text-[10px] text-slate-500">Akses resmi sekolah</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 6. Statistik Database --}}
                <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Stat 1: Kelas -->
                        <div class="stagger-item p-6 sm:p-8 bg-white/80 border border-emerald-100 rounded-3xl shadow-sm transition duration-300 hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-700">
                                    <x-icon name="sekolah" class="w-6 h-6" />
                                </div>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">SD &bull; SMP &bull; SMA</span>
                            </div>
                            <div class="text-3xl sm:text-4xl font-extrabold text-slate-800">{{ $jumlahKelas }}</div>
                            <p class="text-sm font-semibold text-emerald-700 mt-1">Tingkat Kelas Terdaftar</p>
                            <p class="text-xs text-slate-500 mt-1">Mencakup kurikulum lengkap dari kelas 1 sampai 12.</p>
                        </div>

                        <!-- Stat 2: Mata Pelajaran -->
                        <div class="stagger-item p-6 sm:p-8 bg-white/80 border border-sky-100 rounded-3xl shadow-sm transition duration-300 hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-sky-100 flex items-center justify-center text-sky-700">
                                    <x-icon name="buku" class="w-6 h-6" />
                                </div>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-sky-50 text-sky-700 border border-sky-200">Semua Jurusan</span>
                            </div>
                            <div class="text-3xl sm:text-4xl font-extrabold text-slate-800">{{ $jumlahMapel }}</div>
                            <p class="text-sm font-semibold text-sky-700 mt-1">Mata Pelajaran Aktif</p>
                            <p class="text-xs text-slate-500 mt-1">Beragam bidang studi umum maupun peminatan.</p>
                        </div>

                        <!-- Stat 3: Modul Tersedia -->
                        <div class="stagger-item p-6 sm:p-8 bg-white/80 border border-violet-100 rounded-3xl shadow-sm transition duration-300 hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-2xl bg-violet-100 flex items-center justify-center text-violet-700">
                                    <x-icon name="dokumen" class="w-6 h-6" />
                                </div>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-violet-50 text-violet-700 border border-violet-200">File PDF</span>
                            </div>
                            <div class="text-3xl sm:text-4xl font-extrabold text-slate-800">{{ $jumlahModul }}</div>
                            <p class="text-sm font-semibold text-violet-700 mt-1">Modul Digital Tersedia</p>
                            <p class="text-xs text-slate-500 mt-1">Materi ajar yang siap dipelajari dan diunduh.</p>
                        </div>
                    </div>
                </section>

                {{-- 4. Fitur Unggulan --}}
                <section id="fitur" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
                    <div class="text-center max-w-2xl mx-auto mb-12">
                        <span class="text-xs font-semibold px-3 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-600 uppercase tracking-wider">Keunggulan</span>
                        <h2 class="text-3xl font-extrabold text-slate-800 mt-3 tracking-tight">Dirancang untuk memudahkan belajar</h2>
                        <p class="text-slate-600 mt-2 text-sm sm:text-base">Seluruh materi dirancang terstruktur agar siswa dan guru dapat berinteraksi secara efektif.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Fitur 1 -->
                        <div class="p-8 bg-white/50 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-lg shadow-indigo-200/20 hover:shadow-xl hover:bg-white/70 hover:-translate-y-1.5 transition duration-300 ease-out flex flex-col justify-between">
                            <div>
                                <div class="w-14 h-14 rounded-2xl bg-emerald-100/80 text-emerald-600 flex items-center justify-center mb-6">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800">Kelas 1-12 Lengkap</h3>
                                <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                                    Hierarki terstruktur mulai dari jenjang SD, SMP, hingga SMA. Memilih materi pelajaran menjadi intuitif dan tanpa hambatan.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-white/60 text-xs font-medium text-emerald-700 flex items-center gap-1">
                                <span>Navigasi jenjang terpadu</span> &rarr;
                            </div>
                        </div>

                        <!-- Fitur 2 -->
                        <div class="p-8 bg-white/50 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-lg shadow-indigo-200/20 hover:shadow-xl hover:bg-white/70 hover:-translate-y-1.5 transition duration-300 ease-out flex flex-col justify-between">
                            <div>
                                <div class="w-14 h-14 rounded-2xl bg-sky-100/80 text-sky-600 flex items-center justify-center mb-6">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800">Baca & Unduh PDF</h3>
                                <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                                    Membaca langsung modul digital melalui penampil PDF interaktif di peramban, atau unduh ke perangkat untuk belajar offline kapan saja.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-white/60 text-xs font-medium text-sky-700 flex items-center gap-1">
                                <span>Penampil dokumen terintegrasi</span> &rarr;
                            </div>
                        </div>

                        <!-- Fitur 3 -->
                        <div class="p-8 bg-white/50 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-lg shadow-indigo-200/20 hover:shadow-xl hover:bg-white/70 hover:-translate-y-1.5 transition duration-300 ease-out flex flex-col justify-between">
                            <div>
                                <div class="w-14 h-14 rounded-2xl bg-violet-100/80 text-violet-600 flex items-center justify-center mb-6">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800">Dashboard Guru</h3>
                                <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                                    Panel khusus bagi pendidik untuk mengunggah, memperbarui, dan mengelola materi modul secara mandiri dengan keamanan storage privat.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-white/60 text-xs font-medium text-violet-700 flex items-center gap-1">
                                <span>Manajemen materi terarah</span> &rarr;
                            </div>
                        </div>
                    </div>
                </section>

                {{-- 5. Cara Kerja --}}
                <section id="cara-kerja" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
                    <div class="text-center max-w-2xl mx-auto mb-12">
                        <span class="text-xs font-semibold px-3 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-600 uppercase tracking-wider">Langkah Sederhana</span>
                        <h2 class="text-3xl font-extrabold text-slate-800 mt-3 tracking-tight">Cara Kerja E-Modul</h2>
                        <p class="text-slate-600 mt-2 text-sm sm:text-base">Mulai belajar dalam tiga langkah mudah tanpa alur yang rumit.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Langkah 1 -->
                        <div class="p-8 bg-white/50 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-lg shadow-indigo-200/20 relative">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-indigo-50 border border-indigo-200/60 font-bold text-sm text-indigo-600 mb-5">
                                01
                            </span>
                            <h3 class="text-lg font-bold text-slate-800">Pilih Kelas</h3>
                            <p class="text-slate-600 text-sm mt-2 leading-relaxed">
                                Tentukan jenjang pendidikanmu, mulai dari kelas 1 sampai kelas 12 yang terbagi rapi ke dalam SD, SMP, dan SMA.
                            </p>
                        </div>

                        <!-- Langkah 2 -->
                        <div class="p-8 bg-white/50 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-lg shadow-indigo-200/20 relative">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-indigo-50 border border-indigo-200/60 font-bold text-sm text-indigo-600 mb-5">
                                02
                            </span>
                            <h3 class="text-lg font-bold text-slate-800">Pilih Mata Pelajaran</h3>
                            <p class="text-slate-600 text-sm mt-2 leading-relaxed">
                                Temukan mata pelajaran yang ingin kamu pelajari hari ini dari daftar mapel kurikulum yang tersedia.
                            </p>
                        </div>

                        <!-- Langkah 3 -->
                        <div class="p-8 bg-white/50 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-lg shadow-indigo-200/20 relative">
                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-indigo-50 border border-indigo-200/60 font-bold text-sm text-indigo-600 mb-5">
                                03
                            </span>
                            <h3 class="text-lg font-bold text-slate-800">Baca atau Unduh Modul</h3>
                            <p class="text-slate-600 text-sm mt-2 leading-relaxed">
                                Buka modul langsung di peramban atau simpan berkas PDF untuk dibaca kembali tanpa koneksi internet.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- 7. Ajakan Akhir CTA / Tentang --}}
                <section id="tentang" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20">
                    <div class="relative overflow-hidden p-8 sm:p-14 bg-white/60 backdrop-blur-2xl border border-white/80 rounded-3xl shadow-2xl shadow-indigo-200/40 text-center">
                        {{-- Hiasan blob dalam kartu --}}
                        <div class="absolute -top-24 -left-24 w-72 h-72 bg-violet-200/50 rounded-full blur-2xl pointer-events-none"></div>
                        <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-sky-200/50 rounded-full blur-2xl pointer-events-none"></div>

                        <div class="relative z-10 max-w-2xl mx-auto">
                            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 border border-indigo-200">Tentang E-Modul</span>
                            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800 tracking-tight mt-4">
                                Siap tingkatkan pemahaman materi belajarmu?
                            </h2>
                            <p class="text-slate-600 text-sm sm:text-base mt-4 leading-relaxed">
                                E-Modul mempermudah distribusi dan akses materi pembelajaran digital untuk sekolah, guru, dan siswa di seluruh jenjang pendidikan.
                            </p>

                            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                                @auth
                                    <a href="{{ auth()->user()->role === 'guru' ? route('guru.dashboard') : route('siswa.dashboard') }}"
                                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 text-base font-semibold text-white bg-gradient-to-r from-indigo-400 to-violet-400 rounded-2xl hover:from-indigo-500 hover:to-violet-500 hover:-translate-y-0.5 transition duration-300 shadow-lg shadow-indigo-200/50">
                                        <span>Buka Dashboard</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 text-base font-semibold text-white bg-gradient-to-r from-indigo-400 to-violet-400 rounded-2xl hover:from-indigo-500 hover:to-violet-500 hover:-translate-y-0.5 transition duration-300 shadow-lg shadow-indigo-200/50">
                                        <span>Daftar Sekarang Secara Gratis</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </a>
                                    <a href="{{ route('login') }}"
                                       class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 text-base font-semibold text-slate-700 bg-white/60 border border-white/80 rounded-2xl hover:bg-white/90 hover:-translate-y-0.5 transition duration-300 shadow-sm">
                                        Sudah punya akun? Masuk
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            {{-- 8. Footer Sederhana --}}
            <footer class="border-t border-white/50 bg-white/40 backdrop-blur-xl py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                    <div class="flex items-center gap-2">
                        <x-application-logo class="w-6 h-6" />
                        <span class="font-bold text-slate-700 text-sm">E-Modul</span>
                        <span class="text-slate-300">|</span>
                        <span>Materi ajar digital kelas 1–12</span>
                    </div>
                    <div>
                        &copy; {{ date('Y') }} E-Modul. Hak cipta dilindungi undang-undang.
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
