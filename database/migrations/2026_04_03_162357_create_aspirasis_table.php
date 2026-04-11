<?php
// database/migrations/2025_01_01_000008_create_aspirasi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->id('id_aspirasi');
            $table->unsignedBigInteger('user_id');
            $table->string('kategori', 30);
            $table->text('isi_aspirasi');
            $table->string('status', 20)->default('baru');
            $table->string('lampiran', 191)->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};