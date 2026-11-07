<x-guest-layout>
    {{-- Error --}}
    @if ($errors->any())
        <div class="mb-5 p-4 rounded-2xl bg-rose-50/80 border border-rose-200/60 text-sm text-rose-700">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="mb-6">
        <div class="flex items-center gap-3 mb-1">
            <span class="text-2xl">📚</span>
            <h2 class="text-xl font-bold text-slate-800">Masuk sebagai Guru</h2>
        </div>
        <p class="text-sm text-slate-500">Gunakan akun guru Anda untuk masuk.</p>
    </div>

    <form method="POST" action="{{ route('guru.login') }}">
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
                       class="rounded border-gray-300 text-violet-500 shadow-sm focus:ring-violet-400"
                       name="remember">
                <span class="ms-2 text-sm text-slate-600">Ingat saya</span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit"
                    class="w-full py-3 px-4 rounded-2xl text-sm font-semibold text-white bg-gradient-to-r from-violet-400 to-indigo-400 hover:from-violet-500 hover:to-indigo-500 hover:-translate-y-0.5 transition duration-300 shadow-md shadow-violet-200/50">
                Masuk
            </button>
        </div>
    </form>

    <div class="mt-6 flex flex-col items-center gap-2 text-sm">
        <a href="{{ route('guru.daftar') }}"
           class="text-violet-600 hover:text-violet-800 hover:underline transition">
            Belum punya akun? Daftar Guru
        </a>
        <a href="{{ route('login') }}"
           class="text-slate-500 hover:text-slate-700 hover:underline transition">
            ← Kembali ke Pemilih Peran
        </a>
    </div>
</x-guest-layout>
