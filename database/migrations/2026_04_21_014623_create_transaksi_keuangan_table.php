<?php
// database/migrations/2024_01_xx_000002_create_transaksi_keuangan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksi_keuangan', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->date('tanggal');
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->unsignedBigInteger('id_kategori');
            $table->string('deskripsi', 255);
            $table->decimal('jumlah', 15, 2);
            $table->string('bukti_foto')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
            
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_keuangan');
            $table->foreign('created_by')->references('user_id')->on('users');
            $table->foreign('approved_by')->references('user_id')->on('users');
            $table->index('tanggal');
            $table->index('jenis');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi_keuangan');
    }
};