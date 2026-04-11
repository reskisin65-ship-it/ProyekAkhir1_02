<?php
// database/migrations/2025_01_01_000005_create_umkm_table.php

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
            $table->string('nama_usaha', 100);
            $table->string('kategori', 30);
            $table->string('no_telepon', 20);
            $table->string('alamat_usaha', 100);
            $table->string('bukti_usaha', 191)->nullable();
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