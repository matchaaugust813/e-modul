<x-guest-layout>
    {{-- Error / Session Status --}}
    @if ($errors->any())
        <div class="mb-5 p-4 rounded-2xl bg-rose-50/80 dark:bg-rose-950/40 border border-rose-200/60 dark:border-rose-800/60 text-sm text-rose-700 dark:text-rose-300">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="mb-6">
        <div class="flex items-center gap-3 mb-1">
            <x-icon name="siswa" class="w-7 h-7 text-sky-600 dark:text-sky-400" />
            <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100">Masuk sebagai Siswa</h2>
        </div>
        <p class="text-sm text-slate-500 dark:text-slate-400">Gunakan akun siswa Anda untuk masuk.</p>
    </div>

    <form method="POST" action="{{ route('siswa.login') }}">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember Me --}}
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 dark:border-slate-700 dark:bg-slate-900 text-sky-500 shadow-sm focus:ring-sky-400"
                       name="remember">
                <span class="ms-2 text-sm text-slate-600 dark:text-slate-300">Ingat saya</span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="w-full py-3 px-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-sky-400 to-indigo-400 dark:from-sky-500 dark:to-indigo-600 hover:from-sky-500 hover:to-indigo-500 dark:hover:from-sky-400 dark:hover:to-indigo-500 hover:-translate-y-0.5 transition duration-300 shadow-md shadow-sky-200/50 dark:shadow-none">
                Masuk
            </button>
        </div>
    </form>

    <div class="mt-6 flex flex-col items-center gap-2 text-sm">
        <a href="{{ route('siswa.daftar') }}"
           class="text-sky-600 dark:text-sky-400 hover:text-sky-800 dark:hover:text-sky-300 hover:underline transition">
            Belum punya akun? Daftar Siswa
        </a>
        <a href="{{ route('login') }}"
           class="text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 hover:underline transition">
            ← Kembali ke Pemilih Peran
        </a>
    </div>
</x-guest-layout>
