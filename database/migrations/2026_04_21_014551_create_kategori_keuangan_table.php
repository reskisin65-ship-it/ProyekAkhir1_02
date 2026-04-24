<?php
// database/migrations/2024_01_xx_000001_create_kategori_keuangan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kategori_keuangan', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('nama_kategori', 100);
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->string('icon', 50)->default('fa-solid fa-tag');
            $table->string('warna', 20)->default('#10b981');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_keuangan');
    }
};