<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_umkm', function (Blueprint $table) {
            $table->id('id_produk');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('umkm_id');
            $table->string('nama_produk', 100);
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 12, 0);
            $table->string('foto_produk', 191)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('set null');
            $table->foreign('umkm_id')
                ->references('id_umkm')->on('umkm')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_umkm');
    }
};
