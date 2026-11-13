<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditLogService
{
    /**
     * Catat aksi audit ke database
     */
    public static function catat(
        string $aksi,
        ?Model $target = null,
        ?string $keterangan = null,
        ?int $userId = null,
        ?string $ip = null
    ): AuditLog {
        return AuditLog::create([
            'user_id' => $userId ?? Auth::id(),
            'aksi' => $aksi,
            'target_type' => $target ? get_class($target) : null,
            'target_id' => $target ? $target->getKey() : null,
            'keterangan' => $keterangan,
            'ip' => $ip ?? Request::ip() ?? '127.0.0.1',
            'created_at' => now(),
        ]);
    }
}
