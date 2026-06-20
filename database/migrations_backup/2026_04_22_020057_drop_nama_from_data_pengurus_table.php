<?php
// database/migrations/2024_xx_xx_xxxxxx_drop_nama_from_data_pengurus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('data_pengurus', function (Blueprint $table) {
            // Hapus kolom 'nama' (gunakan 'nama_pengurus' saja)
            if (Schema::hasColumn('data_pengurus', 'nama')) {
                $table->dropColumn('nama');
            }
        });
    }

    public function down()
    {
        Schema::table('data_pengurus', function (Blueprint $table) {
            $table->string('nama', 100)->after('id_pengurus');
        });
    }
};