<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    /**
     * Pastikan user yang sudah login berstatus 'active'.
     * Jika tidak, logout dan redirect ke halaman login dengan pesan sesuai.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ! $user->isActive()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($user->isPending()) {
                $message = 'Akun Anda menunggu persetujuan kepala sekolah.';
            } elseif ($user->isRejected()) {
                $message = 'Pendaftaran Anda ditolak. Hubungi administrator untuk informasi lebih lanjut.';
            } else {
                $message = 'Akun Anda tidak aktif. Hubungi administrator.';
            }

            return redirect()->route('login')->withErrors(['email' => $message]);
        }

        return $next($request);
    }
}
