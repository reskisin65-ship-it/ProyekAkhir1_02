<?php
// database/migrations/2025_01_01_000006_create_umkm_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->id('id_umkm');
            $table->unsignedBigInteger('user_id');
            $table->string('nama_usaha');
            $table->string('kategori');
            $table->string('pemilik');  // ← PASTIKAN KOLOM INI ADA
            $table->string('no_telepon', 15);
            $table->text('alamat_usaha');
            $table->text('deskripsi');
            $table->string('logo')->nullable();
            $table->string('bukti_usaha')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};