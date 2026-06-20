<?php
// database/migrations/2025_04_12_000001_add_deskripsi_to_umkm_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            // Tambahkan kolom deskripsi jika belum ada
            if (!Schema::hasColumn('umkm', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('alamat_usaha');
            }
        });
    }

    public function down(): void
    {
        Schema::table('umkm', function (Blueprint $table) {
            $table->dropColumn('deskripsi');
        });
    }
};