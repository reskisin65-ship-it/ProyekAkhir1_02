<?php
// database/migrations/2025_01_01_000002_create_data_pengurus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_pengurus', function (Blueprint $table) {
            $table->id('id_pengurus');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_pengurus', 100);
            $table->string('jabatan', 50);
            $table->string('foto', 191)->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_pengurus');
    }
};