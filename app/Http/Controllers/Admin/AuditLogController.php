<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditLogController extends Controller
{
    /**
     * Tampilkan riwayat audit log.
     */
    public function index(Request $request): View
    {
        $aksi = $request->query('aksi');

        $query = AuditLog::with('user');

        if ($aksi) {
            $query->where('aksi', $aksi);
        }

        $logs = $query->latest('id')->paginate(20)->withQueryString();

        $aksiList = AuditLog::select('aksi')->distinct()->pluck('aksi');

        return view('admin.log.index', compact('logs', 'aksi', 'aksiList'));
    }
}
