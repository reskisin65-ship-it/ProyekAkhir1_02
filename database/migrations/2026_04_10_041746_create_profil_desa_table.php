<?php
// database/migrations/2025_01_01_000001_create_profil_desa_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id('id_profil');
            $table->text('sejarah')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('luas_wilayah', 50)->nullable();
            $table->integer('jumlah_penduduk')->nullable();
            $table->string('foto_kantor', 191)->nullable();
            $table->string('foto_kegiatan', 191)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_desa');
    }
};