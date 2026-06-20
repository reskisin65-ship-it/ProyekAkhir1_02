<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_keuangan', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->date('tanggal');
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->unsignedBigInteger('id_kategori');
            $table->string('deskripsi', 255);
            $table->decimal('jumlah', 15, 2);
            $table->string('bukti_foto')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('id_kategori')
                ->references('id_kategori')->on('kategori_keuangan')
                ->onDelete('restrict');
            $table->foreign('created_by')
                ->references('user_id')->on('users')
                ->onDelete('restrict');
            $table->index('tanggal');
            $table->index('jenis');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_keuangan');
    }
};
