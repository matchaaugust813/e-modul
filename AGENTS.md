# e-modul

Aplikasi modul pembelajaran: Laravel 13 + Breeze (Blade). Hierarki: kelas (1-12)
> mata pelajaran > modul (file PDF). Tiga peran: siswa, guru, superadmin.

## Sudah selesai (Tahap 1)
- Breeze Blade; kolom `role` (siswa/guru) di tabel users; middleware alias `role`
- Redirect login: guru ke /guru/dashboard, siswa ke /siswa/dashboard
- Tabel dan model: kelas, mata_pelajaran, modul (beserta relasi)
- Seeder: 12 kelas, 72 mapel, akun guru@example.com dan siswa@example.com
  (password: password)

## Sudah selesai (Tahap 2)
- ModulPolicy: guru hanya bisa ubah/hapus modul miliknya
- ModulController resource di bawah prefix /guru dengan middleware role:guru
  (index dengan search+pagination, create, store, show, edit, update, destroy)
- File PDF disimpan di disk `private` (storage/app/private/modul) dengan nama ter-hash;
  file lama dihapus saat diganti atau modul dihapus
- Validasi upload: pdf saja, maks 20 MB
- Disk `private` ditambahkan di config/filesystems.php
- Komponen Blade reusable: btn-primary, btn-danger, btn-secondary, form-input,
  form-textarea, card, table, alert
- Views: guru/modul/index, create, edit, _form (dropdown bertingkat Kelas→Mapel via Alpine.js)
- Dashboard guru diperbarui dengan statistik modul dan shortcut ke halaman modul
- Navigasi diperbarui: link "Modul" tampil khusus untuk role guru

## Sudah selesai (Tahap 3)
- KelasController, MapelController, ModulController di bawah namespace Siswa
- 7 route baru di prefix /siswa dengan middleware auth+verified+role:siswa:
  kelas.index, mapel.index, modul.index, modul.baca, modul.unduh, modul.stream
- Alur navigasi: /siswa/kelas → kelas 1-12 dikelompokkan SD/SMP/SMA → mapel → daftar modul
- Tiap modul: tombol "Baca" (iframe PDF) dan "Unduh" (download)
- File PDF dilayani lewat ModulController@stream (bukan URL publik), autentikasi wajib
- Dashboard siswa diperbarui dengan shortcut ke halaman kelas
- Navigasi diperbarui: link "Modul" tampil untuk role siswa (menuju /siswa/kelas)

## Sudah selesai (Tahap 4A)
- Redesain UI glassmorphism: latar gradient tetap (slate-50→indigo-100→sky-100) + 3 blob blur dekoratif
- Layout app & guest: bg-white/50 backdrop-blur-xl border-white/40 rounded-2xl di panel/navbar
- Komponen diperbarui: btn-primary (gradient indigo→violet), btn-secondary (kaca), btn-danger (merah lembut),
  card, table, form-input, form-textarea, alert, nav-link — semua gaya glassmorphism, rounded-xl, tanpa uppercase tracking lebar
- Navbar sticky dengan efek kaca; dropdown trigger bergaya kaca
- Halaman guru: dashboard, modul index/create/edit/_form — warna slate, kartu kaca, tabel tanpa garis berat
- Halaman siswa: dashboard, kelas, mapel, modul index, modul baca — kartu kaca hover naik, iframe PDF dibungkus bingkai kaca
- Halaman profil: panel kaca menggantikan bg-white solid
- npm run build sukses; CSS hasil build memuat backdrop-blur-xl dan bg-white/50 (rgba #ffffff80)

## Sudah selesai (Tahap 4A-2)
- Gaya "soft & smooth": palet pastel lavender/sky/mint/peach, hindari warna jenuh
- Logo SVG inline E-Modul (buku + topi wisuda dalam kotak rounded gradient) menggantikan logo Laravel
- Brand name "E-Modul" di navbar dan title halaman
- Background: gradient pastel fixed (violet-100 → sky-50 → emerald-50) + 4 blob blur bergerak pelan
  (keyframes 22–30 detik ease-in-out infinite, prefers-reduced-motion dihormati)
- Panel: bg-white/50 backdrop-blur-2xl border-white/60 rounded-3xl shadow-lg shadow-indigo-200/20
- Komponen diperbarui: card (rounded-3xl), btn-primary (gradient indigo-400→violet-400, rounded-2xl),
  btn-secondary (kaca rounded-2xl), btn-danger (rose rounded-2xl), form-input/textarea (rounded-2xl),
  alert (rounded-2xl, warna emerald/rose/amber/sky), nav-link, table
- Animasi: page-enter (fade+slide-up 0.4s) di <main>, stagger-item di kartu list
- Scroll halus (scroll-behavior: smooth), focus ring berwarna indigo lembut
- Halaman siswa/kelas: variasi pastel per jenjang (SD=mint emerald, SMP=sky, SMA=lavender violet)
  dengan emoji berbeda (SUDAH TIDAK BERLAKU: emoji dilarang, diganti ikon di Tahap 4C) dan heading berwarna sesuai jenjang
- Semua kartu hover: rounded-3xl, shadow hover naik (-translate-y-1.5), duration-300 ease-out
- Dashboard siswa/guru: ikon dalam wadah bulat rounded-2xl pastel
- npm run build sukses (74.25 kB CSS, 54.32 kB JS)

## Sudah selesai (Halaman Depan / Welcome)
- Desain ulang total welcome.blade.php: gaya soft & smooth glassmorphism, palet pastel lavender/sky/mint/peach
- Navbar kaca sticky: logo + brand E-Modul, link anchor Fitur/Cara Kerja/Tentang, tombol dinamis Masuk/Daftar atau Ke Dashboard (role-based), menu hamburger mobile
- Hero: judul besar & subjudul, aksi Mulai Belajar & Masuk sebagai Guru, ilustrasi dekoratif kartu kaca melayang (float animation)
- Statistik dinamis dari database (jumlah kelas, mapel, modul) lewat rute '/'
- 3 Fitur unggulan (ikon SVG), 3 langkah cara kerja bernomor, kartu CTA kaca besar, dan footer otomatis
- Tanpa library eksternal, font eksternal, atau gambar eksternal (full inline SVG + native Tailwind + Vite)
- npm run build sukses (CSS 79.88 kB, JS 54.32 kB)

## Sudah selesai (Tahap 5A)
- Migration baru: tambah kolom `status` (string, default 'active'), `deleted_at` (soft deletes),
  `kelas_id` (nullable), `nis` (nullable), `mata_pelajaran_diampu` (nullable), `nip` (nullable),
  dan ubah kolom `role` dari enum ke string (agar bisa menampung 'superadmin')
- Model User: tambah `SoftDeletes`, fillable baru, method `isSuperAdmin()`, `isActive()`,
  `isPending()`, `isRejected()`
- Model Modul: relasi `guru()` kini pakai `withTrashed()`
- UserSeeder: diperbarui memakai `updateOrCreate`, tambah akun superadmin `admin@example.com`
  dengan role 'superadmin' dan status 'active'; semua akun lama ditambahkan `status => 'active'`
- Middleware `CheckStatus`: cek status akun setelah login; redirect logout + pesan sesuai
  (pending/rejected/non-active)
- `bootstrap/app.php`: daftarkan alias `status.active` → `CheckStatus`
- Controller Auth baru: `SiswaLoginController`, `GuruLoginController` (cek role + status + rate limit),
  `SiswaDaftarController`, `GuruDaftarController` (role otomatis, status pending, tidak auto-login,
  rate limit 5/jam per IP)
- `routes/auth.php`: route `login` & `register` → view `auth.login-pilih`; tambah route siswa/login,
  guru/login, siswa/daftar, guru/daftar, GET /pending
- `routes/web.php`: middleware `status.active` ditambahkan ke grup guru & siswa
- Views baru: `auth/login-pilih`, `auth/siswa-login`, `auth/guru-login`, `auth/siswa-daftar`,
  `auth/guru-daftar`, `auth/pending` — semua gaya glassmorphism sesuai tema
- `welcome.blade.php`: navbar & hero diperbarui: tombol "Masuk sebagai Siswa" → /siswa/login,
  "Masuk sebagai Guru" → /guru/login, tombol Daftar → route('login') (pemilih peran)
- `php artisan migrate` (berhasil) — `php artisan db:seed --class=UserSeeder` (berhasil) — `npm run build` (berhasil)
  (CSS 56.82 kB, JS 54.32 kB)

## Sudah selesai (Tahap 4C)
- Perintah permanen `php artisan ui:cek-emoji`: memindai teks di seluruh folder proyek untuk mendeteksi karakter emoji/simbol terlarang (exit code 1 jika ada temuan, 0 jika bersih).
- Komponen baru `<x-icon>` (`resources/views/components/icon.blade.php`) dengan SVG inline seragam (viewBox 24, stroke 1.5, stroke currentColor, tanpa fill, `aria-hidden="true"`).
- Pembersihan total emoji di seluruh view (auth, guru, siswa, welcome), digantikan dengan `<x-icon>` dan teks konkret berbahasa Indonesia.
- Audit anti AI slop: hapus teks bergradien dan glow warna-warni; hilangkan kaca di atas kaca; form, tabel, dan area baca teks panjang menggunakan permukaan solid `bg-white/80` ke atas.
- Latar dekoratif statis di seluruh halaman dalam (animasi blob hanya aktif di halaman `welcome`).
- Halaman error kustom berbahasa Indonesia di `resources/views/errors/`: `403.blade.php`, `404.blade.php`, `419.blade.php` ("Sesi Anda berakhir. Muat ulang halaman lalu coba lagi"), `500.blade.php`.
- Konfigurasi locale & timezone: `Asia/Jakarta`, locale `id`, faker `id_ID`, `<html lang="id">`, dan helper bersama `format_tanggal()` ("13 Nov 2026") serta `format_ukuran()` ("2,4 MB").
- Judul tab terstandardisasi `"Judul Halaman | E-Modul"`.
- `php artisan ui:cek-emoji` (bersih, 0 temuan) — `npm run build` (berhasil, CSS 74.39 kB, JS 54.32 kB).

## Sudah selesai (Tahap 5B)
- Perintah CLI `php artisan admin:buat` untuk membuat akun superadmin secara interaktif tanpa form web publik (kata sandi tersembunyi min 12 karakter + konfirmasi).
- Login superadmin terisolasi & tersembunyi di `/{admin_path}/login` (default `/admin/login`, konfigurasi `app.admin_path` / `ADMIN_PATH`), rate limit 5x/jam per IP, pesan seragam "Email atau kata sandi salah.".
- Dashboard superadmin (`/{admin_path}/dashboard`): metrik siswa/guru aktif, pending approval, total modul & ukuran berkas, modul per jenjang, serta daftar 5 pendaftar pending dengan tombol aksi langsung.
- Persetujuan pendaftaran (`/{admin_path}/persetujuan`): filter peran (siswa/guru), aksi Setujui & Tolak akun pending.
- Kelola pengguna (`/{admin_path}/pengguna`): pencarian nama/email, filter peran & status, soft delete, dan pemulihan (restore) akun (modul guru tetap tersimpan via withTrashed).
- Kelola modul (`/{admin_path}/modul`): pencarian, filter kelas/mapel/guru, hapus modul beserta file fisik di disk private (ModulPolicy diperbarui).
- Sistem audit log terpusat (`AuditLogService` & tabel `audit_logs`): mencatat login sukses/gagal, setujui, tolak, hapus/pulihkan akun, dan hapus modul; serta penampil log di `/{admin_path}/log`.
- Navigasi khusus superadmin di `navigation.blade.php` (dengan badge hitungan pending).
- `php artisan migrate` (berhasil) — `php artisan ui:cek-emoji` (bersih, 0 temuan) — `npm run build` (berhasil, CSS 73.39 kB, JS 54.32 kB).

## Status dan urutan tahap berikutnya
- Selesai: Tahap 1, 2, 3, 4A, 4A-2, Welcome, 5A, 4C, 5B.
- Berikutnya: Tahap 4B (Pesan umpan balik, empty state, dan automated feature test).

## Aturan tampilan (wajib, berlaku untuk semua tahap)
- DILARANG memakai emoji di mana pun: view, komponen, pesan, seeder, config, README.
  Termasuk simbol dekoratif seperti centang, silang, bintang, dan tanda peringatan
  bergambar. Ikon hanya lewat komponen `<x-icon>` (SVG inline, satu gaya: stroke 1.5,
  currentColor, `aria-hidden="true"`). Tombol yang hanya berisi ikon wajib punya
  `aria-label`. Tanda baca tipografi biasa (– — ’ “ ” … • · × ← → ›) tetap boleh.
- Sebelum menyatakan tahap selesai, jalankan `php artisan ui:cek-emoji` (dibuat di
  Tahap 4C). Jika ada temuan, hapus dulu. Jangan menyatakan selesai sebelum bersih.
- Hindari tampilan "AI slop":
  - Gradient hanya untuk latar dan satu tombol utama per layar. Dilarang teks
    bergradient, glow warna-warni, dan kaca di atas kaca.
  - Efek kaca hanya untuk navbar dan panel pembungkus. Tabel, form, dan area baca
    memakai permukaan lebih solid (bg-white/80 ke atas) agar terbaca.
  - Satu warna aksen (indigo). Warna jenjang (SD mint, SMP sky, SMA lavender)
    hanya sebagai penanda fungsi, bukan hiasan.
  - Bentuk dan jarak konsisten: dua ukuran radius, satu level bayangan kartu dan
    satu untuk hover, jarak kelipatan 4/8, skala huruf tetap.
  - Animasi hanya fade/slide masuk dan hover naik 1-2px. Blob latar bergerak hanya
    di welcome; halaman dalam statis.
  - Halaman dalam rata kiri dengan hierarki jelas. Empty state berisi teks konkret
    dan satu aksi, bukan ilustrasi besar.
- Teks antarmuka berbahasa Indonesia sehari-hari yang konkret. Dilarang kata
  hiperbola dan klise ("revolusioner", "tingkatkan potensi", "tanpa batas"), tanda
  seru beruntun, serta data palsu (jumlah pengguna, testimoni, rating). Statistik
  hanya dari database.
- Aksesibilitas dasar: kontras teks minimal 4.5:1, focus ring terlihat, setiap input
  punya label, status akun/modul berupa teks (bukan warna saja), target sentuh
  minimal 40px, `<html lang="id">`.
- Judul tab "Judul Halaman | E-Modul". Tanggal format Indonesia (13 Nov 2026), ukuran
  file "2,4 MB", zona waktu Asia/Jakarta.

## Lingkungan
- Windows + Laragon. PHP: C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64\php.exe
- Jangan memasang Laravel Boost. Jangan mengerjakan ulang tahap yang sudah selesai.
- Jangan mengubah struktur Tahap 1 kecuali diminta.

## Aturan
- Gunakan satu layout Blade bersama dan komponen Blade yang dipakai ulang.
- File modul disimpan di disk private, bukan public.
- Kerjakan hanya tahap yang diminta di prompt.
- selalu catat dan update kerjaan kesini ketika sudah selesai
- Perintah rutin: `npm run build` (setiap view/CSS berubah), `php artisan test`,
  `php artisan ui:cek-emoji`.
- Semua aksi ubah data: POST/PUT/DELETE + `@csrf`, validasi input, otorisasi di
  controller atau policy (bukan hanya menyembunyikan tombol).
- Peran dan status pengguna hanya diubah lewat aksi superadmin; abaikan input `role`
  dan `status` dari request mana pun.
- Jangan pernah mengubah test agar lolos. Jika test gagal karena bug aplikasi,
  laporkan nama test, penyebab, dan file terkait.
- Akun demo (guru@example.com, siswa@example.com, admin@example.com) hanya untuk
  APP_ENV=local dan harus dihapus sebelum dipakai pihak lain.
