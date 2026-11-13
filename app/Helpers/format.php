<?php

use Carbon\Carbon;

if (!function_exists('format_tanggal')) {
    /**
     * Format tanggal ke format Indonesia: "13 Nov 2026"
     */
    function format_tanggal($date): string
    {
        if (empty($date)) {
            return '-';
        }

        try {
            $carbon = $date instanceof Carbon ? $date : Carbon::parse($date);
            return $carbon->locale('id')->translatedFormat('d M Y');
        } catch (\Throwable $e) {
            return '-';
        }
    }
}

if (!function_exists('format_ukuran')) {
    /**
     * Format ukuran file dalam byte ke string Indonesia: "2,4 MB"
     */
    function format_ukuran($bytes): string
    {
        if (empty($bytes) || !is_numeric($bytes) || $bytes <= 0) {
            return '-';
        }

        $bytes = (float) $bytes;

        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 1, ',', '.') . ' GB';
        }

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 1, ',', '.') . ' MB';
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 1, ',', '.') . ' KB';
        }

        return number_format($bytes, 0, ',', '.') . ' B';
    }
}
