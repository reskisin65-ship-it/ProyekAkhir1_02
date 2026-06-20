<?php

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
            $table->string('nip', 50)->nullable();
            $table->text('tugas')->nullable();
            $table->string('kategori_jabatan', 50)->default('lainnya');
            $table->integer('level')->default(99);
            $table->integer('urutan_dalam_kategori')->default(0);
            $table->integer('urutan')->default(0);
            $table->string('foto', 191)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_pengurus');
    }
};
