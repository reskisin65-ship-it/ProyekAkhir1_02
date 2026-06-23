<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_surat', function (Blueprint $table) {
            $table->string('nomor_surat', 50)->nullable()->after('file_surat');
            $table->string('file_surat_draft', 191)->nullable()->after('nomor_surat');
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_surat', function (Blueprint $table) {
            $table->dropColumn(['nomor_surat', 'file_surat_draft']);
        });
    }
};
