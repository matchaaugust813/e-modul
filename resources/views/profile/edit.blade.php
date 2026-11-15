<x-app-layout>
    @section('title', 'Profil Saya')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-100 leading-tight">Profil Saya</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Tema Tampilan --}}
            <div class="bg-white/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 shadow-sm dark:shadow-none rounded-3xl p-6 sm:p-8">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-slate-800 dark:text-slate-100">
                                Tema Tampilan
                            </h2>
                            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                                Pilih preferensi tampilan aplikasi antara mode terang, mode gelap, atau mengikuti pengaturan sistem perangkat Anda.
                            </p>
                        </header>
                        <div class="mt-4">
                            <x-theme-toggle />
                        </div>
                    </section>
                </div>
            </div>

            <div class="bg-white/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 shadow-sm dark:shadow-none rounded-3xl p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 shadow-sm dark:shadow-none rounded-3xl p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white/80 dark:bg-slate-900/80 border border-slate-200/80 dark:border-slate-800 shadow-sm dark:shadow-none rounded-3xl p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
