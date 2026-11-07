<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SiswaDaftarController extends Controller
{
    /**
     * Tampilkan form pendaftaran siswa.
     */
    public function create(): View
    {
        return view('auth.siswa-daftar');
    }

    /**
     * Proses pendaftaran siswa.
     * Akun dibuat dengan status 'pending' (menunggu persetujuan) dan TIDAK auto-login.
     */
    public function store(Request $request): RedirectResponse
    {
        // Rate limiting: 5 percobaan per jam per IP
        $throttleKey = 'daftar-siswa|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => 'Terlalu banyak percobaan pendaftaran. Coba lagi dalam '.ceil($seconds / 60).' menit.',
            ]);
        }

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nis'      => ['nullable', 'string', 'max:20'],
        ]);

        RateLimiter::hit($throttleKey, 3600); // 1 jam

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa',
            'status'   => 'pending',
            'nis'      => $request->nis,
        ]);

        return redirect()->route('auth.pending')
            ->with('success', 'Pendaftaran berhasil dikirim! Akun Anda sedang menunggu persetujuan kepala sekolah.');
    }
}
