<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Modul;
use App\Models\User;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ModulController extends Controller
{
    /**
     * Tampilkan semua modul dari seluruh guru.
     */
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', Modul::class);

        $search = $request->query('search');
        $kelasId = $request->query('kelas_id');
        $mapelId = $request->query('mata_pelajaran_id');
        $guruId = $request->query('guru_id');

        $query = Modul::with(['guru', 'mataPelajaran.kelas']);

        if ($search) {
            $query->where('judul', 'like', "%{$search}%");
        }

        if ($guruId) {
            $query->where('guru_id', $guruId);
        }

        if ($mapelId) {
            $query->where('mata_pelajaran_id', $mapelId);
        } elseif ($kelasId) {
            $query->whereHas('mataPelajaran', function ($q) use ($kelasId) {
                $q->where('kelas_id', $kelasId);
            });
        }

        $moduls = $query->latest('id')->paginate(15)->withQueryString();

        $kelasList = Kelas::orderBy('nomor')->get();
        $mapelList = $kelasId ? MataPelajaran::where('kelas_id', $kelasId)->orderBy('nama')->get() : MataPelajaran::orderBy('nama')->get();
        $guruList = User::where('role', 'guru')->withTrashed()->orderBy('name')->get();

        return view('admin.modul.index', compact(
            'moduls',
            'search',
            'kelasId',
            'mapelId',
            'guruId',
            'kelasList',
            'mapelList',
            'guruList'
        ));
    }

    /**
     * Tampilkan halaman baca modul.
     */
    public function baca(Modul $modul): View
    {
        Gate::authorize('view', $modul);
        return view('admin.modul.baca', compact('modul'));
    }

    /**
     * Stream file PDF dari disk private.
     */
    public function stream(Modul $modul): BinaryFileResponse
    {
        Gate::authorize('view', $modul);

        if (! $modul->file_path || ! Storage::disk('private')->exists($modul->file_path)) {
            abort(404, 'File PDF modul tidak ditemukan.');
        }

        $path = Storage::disk('private')->path($modul->file_path);

        return response()->file($path, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($modul->file_path) . '"',
        ]);
    }

    /**
     * Hapus modul dan file fisiknya dari disk private.
     */
    public function destroy(Modul $modul): RedirectResponse
    {
        Gate::authorize('delete', $modul);

        $judul = $modul->judul;
        $guruNama = $modul->guru->name ?? 'Guru Tidak Dikenal';

        // Hapus berkas fisik dari storage private
        if ($modul->file_path && Storage::disk('private')->exists($modul->file_path)) {
            Storage::disk('private')->delete($modul->file_path);
        }

        // Catat audit log sebelum delete record
        AuditLogService::catat(
            aksi: 'hapus modul',
            target: $modul,
            keterangan: "Menghapus modul '{$judul}' karya {$guruNama}"
        );

        $modul->delete();

        return back()->with('success', "Modul '{$judul}' berhasil dihapus.");
    }
}
