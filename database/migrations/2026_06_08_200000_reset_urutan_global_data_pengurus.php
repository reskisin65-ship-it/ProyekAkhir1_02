<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Reset urutan_dalam_kategori menjadi urutan global
     * (bukan per-kategori, tapi lintas semua pengurus).
     * Diurutkan berdasarkan level (hierarki jabatan) lalu id_pengurus.
     */
    public function up(): void
    {
        $rows = DB::table('data_pengurus')
            ->orderBy('level', 'asc')
            ->orderBy('id_pengurus', 'asc')
            ->get(['id_pengurus']);

        foreach ($rows as $index => $row) {
            DB::table('data_pengurus')
                ->where('id_pengurus', $row->id_pengurus)
                ->update(['urutan_dalam_kategori' => $index + 1]);
        }
    }

    public function down(): void
    {
        // Tidak bisa rollback dengan aman karena data lama sudah tidak tersimpan
    }
};
