<x-guest-layout>
    {{-- Error --}}
    @if ($errors->any())
        <div class="mb-5 p-4 rounded-2xl bg-rose-50/80 border border-rose-200/60 text-sm text-rose-700">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="mb-6">
        <div class="flex items-center gap-3 mb-1">
            <span class="text-2xl">🎒</span>
            <h2 class="text-xl font-bold text-slate-800">Daftar sebagai Siswa</h2>
        </div>
        <p class="text-sm text-slate-500">
            Isi data di bawah. Akun Anda akan menunggu persetujuan kepala sekolah.
        </p>
    </div>

    <form method="POST" action="{{ route('siswa.daftar') }}">
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

        {{-- NIS (opsional) --}}
        <div class="mt-4">
            <x-input-label for="nis" value="NIS (Opsional)" />
            <x-text-input id="nis" class="block mt-1 w-full" type="text" name="nis"
                          :value="old('nis')" maxlength="20" placeholder="Nomor Induk Siswa" />
            <x-input-error :messages="$errors->get('nis')" class="mt-2" />
        </div>

        {{-- Info rate limit --}}
        <p class="mt-4 text-xs text-slate-400 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            Pendaftaran dibatasi 5 kali per jam per perangkat.
        </p>

        <div class="mt-6">
            <button type="submit"
                    class="w-full py-3 px-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-sky-400 to-indigo-400 hover:from-sky-500 hover:to-indigo-500 hover:-translate-y-0.5 transition duration-300 shadow-md shadow-sky-200/50">
                Daftar Sekarang
            </button>
        </div>
    </form>

    <div class="mt-6 flex flex-col items-center gap-2 text-sm">
        <a href="{{ route('siswa.login') }}"
           class="text-sky-600 hover:text-sky-800 hover:underline transition">
            Sudah punya akun? Masuk Siswa
        </a>
        <a href="{{ route('login') }}"
           class="text-slate-500 hover:text-slate-700 hover:underline transition">
            ← Kembali ke Pemilih Peran
        </a>
    </div>
</x-guest-layout>
