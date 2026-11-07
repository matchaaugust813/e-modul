<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\GuruDaftarController;
use App\Http\Controllers\Auth\GuruLoginController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SiswaDaftarController;
use App\Http\Controllers\Auth\SiswaLoginController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// ─── Halaman pemilih peran (login & register mengarah ke sini) ───────────────
Route::middleware('guest')->group(function () {
    // Route login & register menampilkan halaman pemilih peran
    Route::get('login', function () {
        return view('auth.login-pilih');
    })->name('login');

    Route::get('register', function () {
        return view('auth.login-pilih');
    })->name('register');

    // ── Login Siswa ──────────────────────────────────────────────────────────
    Route::get('siswa/login', [SiswaLoginController::class, 'create'])->name('siswa.login');
    Route::post('siswa/login', [SiswaLoginController::class, 'store']);

    // ── Login Guru ───────────────────────────────────────────────────────────
    Route::get('guru/login', [GuruLoginController::class, 'create'])->name('guru.login');
    Route::post('guru/login', [GuruLoginController::class, 'store']);

    // ── Daftar Siswa (rate limit 5/jam per IP, ditangani di controller) ──────
    Route::get('siswa/daftar', [SiswaDaftarController::class, 'create'])->name('siswa.daftar');
    Route::post('siswa/daftar', [SiswaDaftarController::class, 'store']);

    // ── Daftar Guru (rate limit 5/jam per IP, ditangani di controller) ───────
    Route::get('guru/daftar', [GuruDaftarController::class, 'create'])->name('guru.daftar');
    Route::post('guru/daftar', [GuruDaftarController::class, 'store']);

    // ── Password reset ───────────────────────────────────────────────────────
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

// ─── Halaman pending (setelah daftar berhasil) ──────────────────────────────
Route::get('pending', function () {
    return view('auth.pending');
})->name('auth.pending');

// ─── Route yang butuh autentikasi ────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
