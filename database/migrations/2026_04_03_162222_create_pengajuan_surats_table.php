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
            $table->string('nik', 16);
            $table->string('status', 20)->default('menunggu');
            $table->string('berkas', 191)->nullable();
            $table->date('tgl_pengajuan');
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