<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('data_pengurus', function (Blueprint $table) {
            // Cek jika kolom belum ada, baru tambahkan
            if (!Schema::hasColumn('data_pengurus', 'urutan')) {
                $table->integer('urutan')->nullable()->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_pengurus', function (Blueprint $table) {
            // Cek jika kolom ada, baru hapus
            if (Schema::hasColumn('data_pengurus', 'urutan')) {
                $table->dropColumn('urutan');
            }
        });
    }
};