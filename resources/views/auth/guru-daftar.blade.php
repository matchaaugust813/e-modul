<x-guest-layout>
    {{-- Error --}}
    @if ($errors->any())
        <div class="mb-5 p-4 rounded-2xl bg-rose-50/80 dark:bg-rose-950/40 border border-rose-200/60 dark:border-rose-800/60 text-sm text-rose-700 dark:text-rose-300">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="mb-6">
        <div class="flex items-center gap-3 mb-1">
            <x-icon name="guru" class="w-7 h-7 text-violet-600 dark:text-violet-400" />
            <h2 class="text-xl font-bold text-slate-800 dark:text-slate-100">Daftar sebagai Guru</h2>
        </div>
        <p class="text-sm text-slate-500 dark:text-slate-400">
            Isi data di bawah. Akun Anda akan menunggu persetujuan kepala sekolah.
        </p>
    </div>

    <form method="POST" action="{{ route('guru.daftar') }}">
        @csrf

        {{-- Nama --}}
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Email --}}
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Konfirmasi Password --}}
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Mata Pelajaran Diampu (opsional) --}}
        <div class="mt-4">
            <x-input-label for="mata_pelajaran_diampu" value="Mata Pelajaran Diampu (Opsional)" />
            <x-text-input id="mata_pelajaran_diampu" class="block mt-1 w-full" type="text"
                          name="mata_pelajaran_diampu" :value="old('mata_pelajaran_diampu')"
                          placeholder="Contoh: Matematika, Fisika" />
            <x-input-error :messages="$errors->get('mata_pelajaran_diampu')" class="mt-2" />
        </div>

        {{-- NIP (opsional) --}}
        <div class="mt-4">
            <x-input-label for="nip" value="NIP (Opsional)" />
            <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip"
                          :value="old('nip')" maxlength="30" placeholder="Nomor Induk Pegawai" />
            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
        </div>

        {{-- Info rate limit --}}
        <p class="mt-4 text-xs text-slate-400 dark:text-slate-500 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 text-amber-400 dark:text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            Pendaftaran dibatasi 5 kali per jam per perangkat.
        </p>

        <div class="mt-6">
            <button type="submit"
                    class="w-full py-3 px-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-violet-400 to-indigo-400 dark:from-violet-500 dark:to-indigo-600 hover:from-violet-500 hover:to-indigo-500 dark:hover:from-violet-400 dark:hover:to-indigo-500 hover:-translate-y-0.5 transition duration-300 shadow-md shadow-violet-200/50 dark:shadow-none">
                Daftar Sekarang
            </button>
        </div>
    </form>

    <div class="mt-6 flex flex-col items-center gap-2 text-sm">
        <a href="{{ route('guru.login') }}"
           class="text-violet-600 dark:text-violet-400 hover:text-violet-800 dark:hover:text-violet-300 hover:underline transition">
            Sudah punya akun? Masuk Guru
        </a>
        <a href="{{ route('login') }}"
           class="text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 hover:underline transition">
            ← Kembali ke Pemilih Peran
        </a>
    </div>
</x-guest-layout>
