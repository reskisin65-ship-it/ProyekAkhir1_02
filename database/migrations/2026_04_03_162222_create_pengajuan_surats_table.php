<?php
// database/migrations/2025_01_01_000007_create_pengajuan_surat_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->id('id_surat');
            $table->unsignedBigInteger('user_id');
            $table->string('jenis_surat', 50);
            $table->string('nama_lengkap', 100);        // ← TAMBAHKAN
            $table->string('nik', 16);
            $table->string('tempat_lahir', 50);         // ← TAMBAHKAN
            $table->date('tanggal_lahir');               // ← TAMBAHKAN
            $table->string('nomor_telepon', 15);         // ← TAMBAHKAN
            $table->text('keperluan');                   // ← TAMBAHKAN
            $table->string('berkas_pendukung', 191)->nullable(); // ← ganti dari 'berkas'
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('catatan_penolakan')->nullable();
            $table->string('file_surat', 191)->nullable();
            $table->date('tgl_pengajuan')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surat');
    }
};