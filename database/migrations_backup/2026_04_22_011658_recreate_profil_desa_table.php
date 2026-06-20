<?php
// database/migrations/2024_xx_xx_xxxxxx_recreate_profil_desa_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('profil_desa');
        
        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id();
            $table->text('sejarah')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('foto_kantor')->nullable();
            $table->string('foto_kegiatan')->nullable();
            $table->string('luas_wilayah')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('tahun_berdiri')->nullable();
            $table->integer('jumlah_dusun')->default(0);
            $table->text('alamat_kantor')->nullable();
            $table->string('email_desa')->nullable();
            $table->string('telepon_desa')->nullable();
            $table->text('maps_embed')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profil_desa');
    }
};