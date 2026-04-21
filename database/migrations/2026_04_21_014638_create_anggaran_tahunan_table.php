<?php
// database/migrations/2024_01_xx_000003_create_anggaran_tahunan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anggaran_tahunan', function (Blueprint $table) {
            $table->id('id_anggaran');
            $table->year('tahun');
            $table->unsignedBigInteger('id_kategori');
            $table->decimal('target_anggaran', 15, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_keuangan');
            $table->unique(['tahun', 'id_kategori']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggaran_tahunan');
    }
};