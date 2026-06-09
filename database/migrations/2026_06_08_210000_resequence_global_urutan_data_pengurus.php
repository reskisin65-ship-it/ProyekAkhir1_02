<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Resequence urutan_dalam_kategori menjadi 1,2,3,... global tanpa duplikat.
     * Diurutkan berdasarkan urutan_dalam_kategori saat ini, lalu level, lalu id_pengurus.
     */
    public function up(): void
    {
        $rows = DB::table('data_pengurus')
            ->orderBy('urutan_dalam_kategori', 'asc')
            ->orderBy('level', 'asc')
            ->orderBy('id_pengurus', 'asc')
            ->pluck('id_pengurus');

        foreach ($rows as $index => $id) {
            DB::table('data_pengurus')
                ->where('id_pengurus', $id)
                ->update(['urutan_dalam_kategori' => $index + 1]);
        }
    }

    public function down(): void {}
};
