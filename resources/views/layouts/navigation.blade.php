<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/50 dark:bg-slate-900/60 backdrop-blur-2xl border-b border-white/60 dark:border-white/10 shadow-sm supports-[backdrop-filter]:bg-white/50 dark:supports-[backdrop-filter]:bg-slate-900/60">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo + Brand name -->
                <div class="shrink-0 flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <x-application-logo class="block h-9 w-auto transition duration-300 group-hover:scale-105" />
                        <span class="font-semibold text-slate-700 dark:text-slate-100 text-base tracking-tight hidden sm:inline">E-Modul</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        @if(auth()->user()->isSuperAdmin())
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                Dashboard
                            </x-nav-link>
                            @php
                                $pendingCount = \App\Models\User::where('status', 'pending')->count();
                            @endphp
                            <x-nav-link :href="route('admin.persetujuan.index')" :active="request()->routeIs('admin.persetujuan.*')">
                                <span>Persetujuan</span>
                                @if($pendingCount > 0)
                                    <span class="ml-1.5 px-2 py-0.5 text-xs font-semibold rounded-full bg-amber-100 dark:bg-amber-950/40 text-amber-800 dark:text-amber-300 border border-amber-300 dark:border-amber-800/60">
                                        {{ $pendingCount }}
                                    </span>
                                @endif
                            </x-nav-link>
                            <x-nav-link :href="route('admin.pengguna.index')" :active="request()->routeIs('admin.pengguna.*')">
                                Pengguna
                            </x-nav-link>
                            <x-nav-link :href="route('admin.modul.index')" :active="request()->routeIs('admin.modul.*')">
                                Modul
                            </x-nav-link>
                            <x-nav-link :href="route('admin.log.index')" :active="request()->routeIs('admin.log.*')">
                                Log Aktivitas
                            </x-nav-link>
                        @elseif(auth()->user()->role === 'guru')
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('guru.dashboard')">
                                Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('guru.modul.index')" :active="request()->routeIs('guru.modul.*')">
                                Modul
                            </x-nav-link>
                        @elseif(auth()->user()->role === 'siswa')
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('siswa.dashboard')">
                                Dashboard
                            </x-nav-link>
                            <x-nav-link :href="route('siswa.kelas.index')" :active="request()->routeIs('siswa.kelas.*') || request()->routeIs('siswa.mapel.*') || request()->routeIs('siswa.modul.*')">
                                Modul
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown & Theme Toggle -->
            <div class="hidden sm:flex sm:items-center sm:gap-3 sm:ms-6">
                <x-theme-toggle />

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 bg-white/50 dark:bg-slate-800/70 border border-white/60 dark:border-white/10 rounded-2xl text-sm font-medium text-slate-700 dark:text-slate-200 hover:bg-white/70 dark:hover:bg-slate-700/70 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-300 dark:focus:ring-indigo-400 transition duration-300">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Keluar
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-2xl text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 hover:bg-white/50 dark:hover:bg-slate-800/50 focus:outline-none transition duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-white/40 dark:border-white/10 bg-white/60 dark:bg-slate-900/90 backdrop-blur-2xl">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(auth()->user()->isSuperAdmin())
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.persetujuan.index')" :active="request()->routeIs('admin.persetujuan.*')">
                        Persetujuan
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.pengguna.index')" :active="request()->routeIs('admin.pengguna.*')">
                        Pengguna
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.modul.index')" :active="request()->routeIs('admin.modul.*')">
                        Modul
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.log.index')" :active="request()->routeIs('admin.log.*')">
                        Log Aktivitas
                    </x-responsive-nav-link>
                @elseif(auth()->user()->role === 'guru')
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('guru.dashboard')">
                        Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('guru.modul.index')" :active="request()->routeIs('guru.modul.*')">
                        Modul
                    </x-responsive-nav-link>
                @elseif(auth()->user()->role === 'siswa')
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('siswa.dashboard')">
                        Dashboard
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('siswa.kelas.index')" :active="request()->routeIs('siswa.kelas.*') || request()->routeIs('siswa.mapel.*') || request()->routeIs('siswa.modul.*')">
                        Modul
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options & Theme Toggle -->
        <div class="pt-4 pb-3 border-t border-white/40 dark:border-white/10">
            <div class="px-4 flex items-center justify-between pb-3">
                <span class="text-sm font-medium text-slate-600 dark:text-slate-300">Tema Tampilan</span>
                <x-theme-toggle />
            </div>

            <div class="px-4 pt-2 border-t border-white/30 dark:border-white/10">
                <div class="font-semibold text-base text-slate-800 dark:text-slate-100">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profil
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        Keluar
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
