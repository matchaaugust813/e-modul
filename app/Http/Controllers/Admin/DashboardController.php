<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Modul;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard superadmin.
     */
    public function index(): View
    {
        $siswaAktif = User::where('role', 'siswa')->where('status', 'active')->count();
        $guruAktif = User::where('role', 'guru')->where('status', 'active')->count();
        $akunPending = User::where('status', 'pending')->count();

        $totalModul = Modul::count();
        $totalUkuran = Modul::sum('ukuran') ?: 0;

        // Hitung modul per jenjang via relasi mataPelajaran -> kelas
        $modulPerJenjang = Modul::join('mata_pelajarans', 'moduls.mata_pelajaran_id', '=', 'mata_pelajarans.id')
            ->join('kelas', 'mata_pelajarans.kelas_id', '=', 'kelas.id')
            ->select('kelas.jenjang', DB::raw('count(moduls.id) as total'))
            ->groupBy('kelas.jenjang')
            ->pluck('total', 'jenjang')
            ->toArray();

        // 5 pendaftar pending terbaru
        $pendaftarTerbaru = User::where('status', 'pending')
            ->with('kelas')
            ->latest('id')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'siswaAktif',
            'guruAktif',
            'akunPending',
            'totalModul',
            'totalUkuran',
            'modulPerJenjang',
            'pendaftarTerbaru'
        ));
    }
}
