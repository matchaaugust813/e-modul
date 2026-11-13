<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Halaman persetujuan pendaftaran (khusus status pending).
     */
    public function persetujuan(Request $request): View
    {
        $role = $request->query('role');

        $query = User::where('status', 'pending')->with('kelas');

        if ($role && in_array($role, ['siswa', 'guru'])) {
            $query->where('role', $role);
        }

        $pendingUsers = $query->latest('id')->paginate(15)->withQueryString();

        return view('admin.persetujuan.index', compact('pendingUsers', 'role'));
    }

    /**
     * Halaman kelola semua pengguna (guru dan siswa).
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $role = $request->query('role');
        $status = $request->query('status');

        $query = User::with('kelas');

        // Status dihapus (soft-deleted)
        if ($status === 'dihapus') {
            $query->onlyTrashed();
        } else {
            $query->withTrashed();
            if ($status && in_array($status, ['active', 'pending', 'rejected'])) {
                $query->where('status', $status)->whereNull('deleted_at');
            }
        }

        if ($role && in_array($role, ['siswa', 'guru', 'superadmin'])) {
            $query->where('role', $role);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest('id')->paginate(15)->withQueryString();

        return view('admin.pengguna.index', compact('users', 'search', 'role', 'status'));
    }

    /**
     * Setujui pendaftaran akun.
     */
    public function setujui(User $user): RedirectResponse
    {
        if (! $user->isPending() && $user->status !== 'rejected') {
            return back()->with('error', 'Hanya akun berstatus pending atau rejected yang dapat disetujui.');
        }

        $user->status = 'active';
        $user->save();

        AuditLogService::catat(
            aksi: 'setujui',
            target: $user,
            keterangan: "Menyetujui akun {$user->name} ({$user->email})"
        );

        return back()->with('success', "Akun {$user->name} berhasil disetujui.");
    }

    /**
     * Tolak pendaftaran akun.
     */
    public function tolak(User $user): RedirectResponse
    {
        if ($user->isSuperAdmin() || $user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menolak akun superadmin.');
        }

        $user->status = 'rejected';
        $user->save();

        AuditLogService::catat(
            aksi: 'tolak',
            target: $user,
            keterangan: "Menolak akun {$user->name} ({$user->email})"
        );

        return back()->with('success', "Akun {$user->name} telah ditolak.");
    }

    /**
     * Soft delete akun pengguna.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->isSuperAdmin() || $user->id === auth()->id()) {
            return back()->with('error', 'Superadmin tidak dapat menghapus akunnya sendiri atau superadmin lain.');
        }

        $userName = $user->name;
        $userEmail = $user->email;

        $user->delete();

        AuditLogService::catat(
            aksi: 'hapus akun',
            target: $user,
            keterangan: "Menghapus akun {$userName} ({$userEmail})"
        );

        return back()->with('success', "Akun {$userName} berhasil dinonaktifkan (dihapus).");
    }

    /**
     * Pulihkan akun yang di-soft delete.
     */
    public function pulihkan(int $id): RedirectResponse
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        AuditLogService::catat(
            aksi: 'pulihkan akun',
            target: $user,
            keterangan: "Memulihkan akun {$user->name} ({$user->email})"
        );

        return back()->with('success', "Akun {$user->name} berhasil dipulihkan.");
    }
}
