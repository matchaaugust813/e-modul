# e-modul

Aplikasi modul pembelajaran: Laravel 13 + Breeze (Blade). Hierarki: kelas (1-12)
> mata pelajaran > modul (file PDF). Dua peran: siswa dan guru.

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
  dengan emoji berbeda dan heading berwarna sesuai jenjang
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
- `php artisan migrate` ✓ — `php artisan db:seed --class=UserSeeder` ✓ — `npm run build` ✓
  (CSS 56.82 kB, JS 54.32 kB)

## Lingkungan
- Windows + Laragon. PHP: C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64\php.exe
- Jangan memasang Laravel Boost. Jangan mengerjakan ulang tahap yang sudah selesai.
- Jangan mengubah struktur Tahap 1 kecuali diminta.

## Aturan
- Gunakan satu layout Blade bersama dan komponen Blade yang dipakai ulang.
- File modul disimpan di disk private, bukan public.
- Kerjakan hanya tahap yang diminta di prompt.
- selalu catat dan update kerjaan kesini ketika sudah selesai