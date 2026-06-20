<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
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

            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_desa');
    }
};
