<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('pengajuan_surat', 'keterangan')) {
            Schema::table('pengajuan_surat', function (Blueprint $table) {
                $table->text('keterangan')->nullable()->after('keperluan');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pengajuan_surat', 'keterangan')) {
            Schema::table('pengajuan_surat', function (Blueprint $table) {
                $table->dropColumn('keterangan');
            });
        }
    }
};