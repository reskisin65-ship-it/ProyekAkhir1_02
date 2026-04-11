<?php
// database/migrations/2025_01_01_000003_create_berita_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->unsignedBigInteger('user_id');
            $table->string('judul', 191);
            $table->text('isi_berita');
            $table->string('kategori', 30);
            $table->string('foto', 191)->nullable();
            $table->string('status', 20)->default('draft');
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};