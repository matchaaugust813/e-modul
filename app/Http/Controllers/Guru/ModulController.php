<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ModulController extends Controller
{
    /**
     * Tampilkan daftar modul milik guru yang login.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Modul::class);

        $search = $request->get('search');

        $moduls = Modul::with(['mataPelajaran.kelas'])
            ->where('guru_id', auth()->id())
            ->when($search, fn($q) => $q->where('judul', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('guru.modul.index', compact('moduls', 'search'));
    }

    /**
     * Form tambah modul.
     */
    public function create()
    {
        Gate::authorize('create', Modul::class);

        $kelasList = Kelas::with('mataPelajarans')->orderBy('nomor')->get();
        return view('guru.modul.create', compact('kelasList'));
    }

    /**
     * Simpan modul baru.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Modul::class);

        $validated = $request->validate([
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajarans,id'],
            'judul'             => ['required', 'string', 'max:255'],
            'deskripsi'         => ['nullable', 'string'],
            'file'              => ['required', 'file', 'mimes:pdf', 'max:20480'],
        ]);

        $file     = $request->file('file');
        $hashed   = Str::random(40) . '.pdf';
        $filePath = $file->storeAs('modul', $hashed, 'private');

        Modul::create([
            'mata_pelajaran_id' => $validated['mata_pelajaran_id'],
            'guru_id'           => auth()->id(),
            'judul'             => $validated['judul'],
            'deskripsi'         => $validated['deskripsi'] ?? null,
            'file_path'         => $filePath,
            'ukuran'            => $file->getSize(),
        ]);

        return redirect()->route('guru.modul.index')
            ->with('success', 'Modul berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail modul.
     */
    public function show(Modul $modul)
    {
        Gate::authorize('view', $modul);

        return view('guru.modul.show', compact('modul'));
    }

    /**
     * Form ubah modul.
     */
    public function edit(Modul $modul)
    {
        Gate::authorize('update', $modul);

        $kelasList = Kelas::with('mataPelajarans')->orderBy('nomor')->get();
        return view('guru.modul.edit', compact('modul', 'kelasList'));
    }

    /**
     * Simpan perubahan modul.
     */
    public function update(Request $request, Modul $modul)
    {
        Gate::authorize('update', $modul);

        $validated = $request->validate([
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajarans,id'],
            'judul'             => ['required', 'string', 'max:255'],
            'deskripsi'         => ['nullable', 'string'],
            'file'              => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
        ]);

        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($modul->file_path && Storage::disk('private')->exists($modul->file_path)) {
                Storage::disk('private')->delete($modul->file_path);
            }
            $file     = $request->file('file');
            $hashed   = Str::random(40) . '.pdf';
            $filePath = $file->storeAs('modul', $hashed, 'private');
            $modul->file_path = $filePath;
            $modul->ukuran    = $file->getSize();
        }

        $modul->mata_pelajaran_id = $validated['mata_pelajaran_id'];
        $modul->judul             = $validated['judul'];
        $modul->deskripsi         = $validated['deskripsi'] ?? null;
        $modul->save();

        return redirect()->route('guru.modul.index')
            ->with('success', 'Modul berhasil diperbarui.');
    }

    /**
     * Hapus modul beserta filenya.
     */
    public function destroy(Modul $modul)
    {
        Gate::authorize('delete', $modul);

        if ($modul->file_path && Storage::disk('private')->exists($modul->file_path)) {
            Storage::disk('private')->delete($modul->file_path);
        }
        $modul->delete();

        return redirect()->route('guru.modul.index')
            ->with('success', 'Modul berhasil dihapus.');
    }
}

