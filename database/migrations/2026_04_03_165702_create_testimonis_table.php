<?php
// database/migrations/2025_01_01_000009_create_testimoni_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimoni', function (Blueprint $table) {
            $table->id('id_testimoni');
            $table->unsignedBigInteger('user_id');
            $table->text('isi_testimoni');
            $table->integer('rating')->default(5);
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimoni');
    }
};