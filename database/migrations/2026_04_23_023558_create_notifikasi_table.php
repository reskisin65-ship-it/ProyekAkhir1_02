<?php
// database/migrations/2026_04_23_xxxxxx_create_notifikasi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('jenis')->default('umum');
            $table->string('judul');
            $table->text('pesan');
            $table->string('link')->nullable();
            $table->unsignedBigInteger('ref_id')->nullable();
            $table->boolean('dibaca')->default(false);
            $table->timestamps();
            
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'dibaca']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};