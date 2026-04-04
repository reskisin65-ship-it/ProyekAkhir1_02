<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void {
    Schema::create('pengajuan_surats', function (Blueprint $table) {
        $table->id();
        // FK ke tabel users (Siapa pemohonnya)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        
        $table->string('nik', 20); // Snapshot NIK saat pengajuan
        $table->string('jenis_surat', 100); // Contoh: Surat Domisili
        $table->text('keperluan');
        $table->enum('status', ['pending', 'diproses', 'selesai', 'ditolak'])->default('pending');
        $table->date('tgl_pengajuan');
        $table->string('nama_berkas', 255)->nullable(); // Nama file persyaratan yang diupload
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};
