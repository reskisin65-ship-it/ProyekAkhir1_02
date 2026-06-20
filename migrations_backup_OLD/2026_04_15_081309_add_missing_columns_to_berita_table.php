<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // Tambahkan kolom jika belum ada
            if (!Schema::hasColumn('berita', 'ringkasan')) {
                $table->text('ringkasan')->nullable()->after('judul');
            }
            if (!Schema::hasColumn('berita', 'tanggal_publikasi')) {
                $table->date('tanggal_publikasi')->nullable()->after('ringkasan');
            }
            if (!Schema::hasColumn('berita', 'dibaca')) {
                $table->integer('dibaca')->default(0)->after('tanggal_publikasi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            if (Schema::hasColumn('berita', 'ringkasan')) {
                $table->dropColumn('ringkasan');
            }
            if (Schema::hasColumn('berita', 'tanggal_publikasi')) {
                $table->dropColumn('tanggal_publikasi');
            }
            if (Schema::hasColumn('berita', 'dibaca')) {
                $table->dropColumn('dibaca');
            }
        });
    }
};