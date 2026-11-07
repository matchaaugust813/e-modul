<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Modul;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ModulController extends Controller
{
    /**
     * Tampilkan daftar modul untuk mata pelajaran tertentu.
     */
    public function index(MataPelajaran $mataPelajaran)
    {
        $moduls = $mataPelajaran->moduls()->latest()->get();
        $kelas  = $mataPelajaran->kelas;

        return view('siswa.modul.index', compact('mataPelajaran', 'moduls', 'kelas'));
    }

    /**
     * Tampilkan halaman baca modul (iframe PDF).
     */
    public function baca(Modul $modul)
    {
        abort_unless(
            Storage::disk('private')->exists($modul->file_path),
            404,
            'File modul tidak ditemukan.'
        );

        return view('siswa.modul.baca', compact('modul'));
    }

    /**
     * Unduh file PDF modul (autentikasi wajib, dilayani controller).
     */
    public function unduh(Modul $modul)
    {
        abort_unless(
            Storage::disk('private')->exists($modul->file_path),
            404,
            'File modul tidak ditemukan.'
        );

        $filePath = Storage::disk('private')->path($modul->file_path);
        $fileName = \Illuminate\Support\Str::slug($modul->judul) . '.pdf';

        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    /**
     * Stream PDF untuk ditampilkan di iframe (autentikasi wajib).
     */
    public function stream(Modul $modul)
    {
        abort_unless(
            Storage::disk('private')->exists($modul->file_path),
            404,
            'File modul tidak ditemukan.'
        );

        $filePath = Storage::disk('private')->path($modul->file_path);

        return response()->file($filePath, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline',
        ]);
    }
}
