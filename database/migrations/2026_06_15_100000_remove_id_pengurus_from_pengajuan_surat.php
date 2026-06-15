<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('pengajuan_surat', 'id_pengurus')) {
            Schema::table('pengajuan_surat', function (Blueprint $table) {
                $table->dropForeign(['id_pengurus']);
                $table->dropColumn('id_pengurus');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('pengajuan_surat', 'id_pengurus')) {
            Schema::table('pengajuan_surat', function (Blueprint $table) {
                $table->unsignedBigInteger('id_pengurus')->nullable()->after('user_id');
                $table->foreign('id_pengurus')
                      ->references('id_pengurus')
                      ->on('data_pengurus')
                      ->onDelete('set null');
            });
        }
    }
};
