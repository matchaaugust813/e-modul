<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminLoginController extends Controller
{
    /**
     * Tampilkan form login superadmin.
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Proses autentikasi superadmin.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $throttleKey = Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => __('auth.throttle', ['seconds' => $seconds, 'minutes' => ceil($seconds / 60)]),
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::hit($throttleKey, 300);
            AuditLogService::catat(
                aksi: 'login admin gagal',
                keterangan: 'Percobaan login email tidak valid atau password salah: ' . $request->input('email'),
                ip: $request->ip()
            );

            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi salah.',
            ]);
        }

        $user = Auth::user();

        // Hanya menerima role superadmin berstatus active
        if (! $user->isSuperAdmin() || ! $user->isActive()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            RateLimiter::hit($throttleKey, 300);

            AuditLogService::catat(
                aksi: 'login admin gagal',
                keterangan: 'Bukan superadmin aktif mencoba login: ' . $user->email,
                ip: $request->ip()
            );

            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi salah.',
            ]);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        AuditLogService::catat(
            aksi: 'login admin berhasil',
            target: $user,
            keterangan: 'Superadmin ' . $user->name . ' berhasil masuk',
            userId: $user->id,
            ip: $request->ip()
        );

        $adminPath = config('app.admin_path', 'admin');
        return redirect()->intended(url($adminPath . '/dashboard'));
    }
}
