<?php
// database/migrations/2025_01_01_000010_create_notifikasi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('id_notifikasi');
            $table->unsignedBigInteger('user_id');
            $table->string('judul', 191);
            $table->text('pesan');
            $table->timestamps();
            
            // PERBAIKAN: gunakan ->on('users') BUKAN -->('users')
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')           // ← ini yang benar
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};