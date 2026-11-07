{{-- Logo E-Modul: buku dalam kotak rounded gradient pastel --}}
<svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#a5b4fc"/>
            <stop offset="100%" style="stop-color:#7dd3fc"/>
        </linearGradient>
    </defs>
    {{-- kotak rounded --}}
    <rect x="2" y="2" width="44" height="44" rx="12" ry="12" fill="url(#logoGrad)" opacity="0.85"/>
    {{-- buku --}}
    <rect x="12" y="11" width="14" height="20" rx="2" fill="white" opacity="0.9"/>
    <rect x="22" y="11" width="14" height="20" rx="2" fill="white" opacity="0.7"/>
    <line x1="24" y1="11" x2="24" y2="31" stroke="#818cf8" stroke-width="1.5"/>
    {{-- garis teks buku kiri --}}
    <line x1="15" y1="17" x2="22" y2="17" stroke="#a5b4fc" stroke-width="1.2" stroke-linecap="round"/>
    <line x1="15" y1="20" x2="22" y2="20" stroke="#a5b4fc" stroke-width="1.2" stroke-linecap="round"/>
    <line x1="15" y1="23" x2="22" y2="23" stroke="#a5b4fc" stroke-width="1.2" stroke-linecap="round"/>
    {{-- topi wisuda --}}
    <polygon points="24,34 18,37 24,40 30,37" fill="white" opacity="0.9"/>
    <line x1="24" y1="34" x2="24" y2="40" stroke="#818cf8" stroke-width="1" stroke-linecap="round"/>
    <line x1="30" y1="37" x2="30" y2="40" stroke="white" stroke-width="1.5" stroke-linecap="round" opacity="0.8"/>
</svg>
</svg>
