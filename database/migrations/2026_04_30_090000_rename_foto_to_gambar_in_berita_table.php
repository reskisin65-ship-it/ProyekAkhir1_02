<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Cek apakah kolom gambar sudah ada
        if (!Schema::hasColumn('berita', 'gambar')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->string('gambar', 191)->nullable()->after('kategori');
            });
            
            // Copy data dari foto ke gambar jika foto ada
            DB::statement('UPDATE berita SET gambar = foto WHERE foto IS NOT NULL');
        }
    }

    public function down(): void
    {
        // Jangan drop kolom foto, hanya rollback gambar
        if (Schema::hasColumn('berita', 'gambar')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->dropColumn('gambar');
            });
        }
    }
};

