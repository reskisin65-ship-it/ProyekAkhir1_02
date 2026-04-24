<?php
// database/migrations/2024_xx_xx_xxxxxx_add_nama_to_data_pengurus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('data_pengurus', function (Blueprint $table) {
            // Cek apakah kolom 'nama' belum ada
            if (!Schema::hasColumn('data_pengurus', 'nama')) {
                $table->string('nama', 100)->after('id_pengurus');
            }
        });
    }

    public function down()
    {
        Schema::table('data_pengurus', function (Blueprint $table) {
            $table->dropColumn('nama');
        });
    }
};