<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->id('id_aspirasi');
            $table->unsignedBigInteger('user_id');
            $table->string('judul', 255);
            $table->text('isi_aspirasi');
            $table->text('respon_admin')->nullable();  // KOLOM UNTUK BALASAN ADMIN
            $table->enum('kategori', ['saran', 'keluhan', 'masukan', 'pertanyaan'])->default('saran');
            $table->enum('status', ['baru', 'diproses', 'selesai'])->default('baru');
            $table->string('lampiran')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->index('status');
            $table->index('kategori');
        });
    }

    public function down()
    {
        Schema::dropIfExists('aspirasi');
    }
};