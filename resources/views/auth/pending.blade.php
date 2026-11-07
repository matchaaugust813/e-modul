<x-guest-layout>
    <div class="text-center">
        {{-- Ikon sukses --}}
        <div class="mx-auto w-20 h-20 rounded-full bg-emerald-100/80 flex items-center justify-center text-5xl mb-6 shadow-inner">
            ✅
        </div>

        <h2 class="text-2xl font-bold text-slate-800">Pendaftaran Terkirim!</h2>

        <p class="mt-4 text-sm text-slate-600 leading-relaxed">
            Akun Anda telah berhasil didaftarkan dan sedang menunggu persetujuan kepala sekolah.
            Anda akan dapat masuk setelah akun disetujui.
        </p>

        @if (session('success'))
            <div class="mt-5 p-4 rounded-2xl bg-emerald-50/80 border border-emerald-200/60 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-6 p-5 rounded-2xl bg-amber-50/80 border border-amber-200/60 text-left">
            <div class="flex items-start gap-3">
                <span class="text-xl mt-0.5">⏳</span>
                <div>
                    <p class="text-sm font-semibold text-amber-800">Menunggu Persetujuan</p>
                    <p class="text-xs text-amber-700 mt-1">
                        Kepala sekolah akan meninjau pendaftaran Anda. Proses ini biasanya membutuhkan
                        1–2 hari kerja. Pantau email Anda untuk informasi lebih lanjut.
                    </p>
                </div>
            </div>
        </div>

        <a href="{{ url('/') }}"
           class="mt-8 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-2xl text-sm font-semibold text-slate-700 bg-white/60 border border-white/80 hover:bg-white/90 hover:-translate-y-0.5 transition duration-300 shadow-sm">
            ← Kembali ke Halaman Utama
        </a>
    </div>
</x-guest-layout>
