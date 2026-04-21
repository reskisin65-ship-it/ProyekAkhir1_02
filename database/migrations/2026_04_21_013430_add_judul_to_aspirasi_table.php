<?php
// database/migrations/2024_01_xx_xxxxxx_add_judul_to_aspirasi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('aspirasi', function (Blueprint $table) {
            $table->string('judul', 255)->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('aspirasi', function (Blueprint $table) {
            $table->dropColumn('judul');
        });
    }
};