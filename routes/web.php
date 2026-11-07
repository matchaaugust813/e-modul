<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\ModulController as GuruModulController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboard;
use App\Http\Controllers\Siswa\KelasController as SiswaKelasController;
use App\Http\Controllers\Siswa\MapelController as SiswaMapelController;
use App\Http\Controllers\Siswa\ModulController as SiswaModulController;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Modul;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'jumlahKelas'  => Kelas::count(),
        'jumlahMapel'  => MataPelajaran::count(),
        'jumlahModul'  => Modul::count(),
    ]);
});

// Route lama /dashboard dialihkan berdasarkan role setelah login
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user && $user->role === 'guru') {
        return redirect()->route('guru.dashboard');
    }
    return redirect()->route('siswa.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard Guru
Route::middleware(['auth', 'verified', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');
        Route::resource('modul', GuruModulController::class);
    });

// Dashboard Siswa
Route::middleware(['auth', 'verified', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        Route::get('/dashboard', [SiswaDashboard::class, 'index'])->name('dashboard');
        Route::get('/kelas', [SiswaKelasController::class, 'index'])->name('kelas.index');
        Route::get('/kelas/{kelas}/mapel', [SiswaMapelController::class, 'index'])->name('mapel.index');
        Route::get('/mapel/{mataPelajaran}/modul', [SiswaModulController::class, 'index'])->name('modul.index');
        Route::get('/modul/{modul}/baca', [SiswaModulController::class, 'baca'])->name('modul.baca');
        Route::get('/modul/{modul}/unduh', [SiswaModulController::class, 'unduh'])->name('modul.unduh');
        Route::get('/modul/{modul}/stream', [SiswaModulController::class, 'stream'])->name('modul.stream');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
