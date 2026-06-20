<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_keuangan', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_kategori', 100);
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->string('icon', 50)->default('fa-solid fa-tag');
            $table->string('warna', 20)->default('#10b981');
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_keuangan');
    }
};
