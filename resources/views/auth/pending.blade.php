<x-guest-layout>
    <div class="text-center">
        {{-- Ikon sukses --}}
        <div class="mx-auto w-20 h-20 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 mb-6 shadow-inner">
            <x-icon name="centang" class="w-10 h-10" />
        </div>

        <h2 class="text-2xl font-bold text-slate-800">Pendaftaran Berhasil Dikirim</h2>

        <p class="mt-4 text-sm text-slate-600 leading-relaxed">
            Akun Anda telah didaftarkan dan sedang menunggu persetujuan kepala sekolah.
            Anda akan dapat masuk setelah akun disetujui.
        </p>

        @if (session('success'))
            <div class="mt-5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200/60 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-6 p-5 rounded-2xl bg-amber-50 border border-amber-200/60 text-left">
            <div class="flex items-start gap-3">
                <x-icon name="jam" class="w-5 h-5 text-amber-700 mt-0.5 flex-shrink-0" />
                <div>
                    <p class="text-sm font-semibold text-amber-800">Menunggu Persetujuan</p>
                    <p class="text-xs text-amber-700 mt-1">
                        Kepala sekolah akan meninjau pendaftaran Anda. Proses ini membutuhkan
                        1–2 hari kerja. Pantau email Anda untuk informasi lebih lanjut.
                    </p>
                </div>
            </div>
        </div>

        <a href="{{ url('/') }}"
           class="mt-8 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl text-sm font-semibold text-slate-700 bg-white/80 border border-slate-200 hover:bg-white hover:-translate-y-0.5 transition duration-300 shadow-sm">
            Kembali ke Halaman Utama
        </a>
    </div>
</x-guest-layout>
