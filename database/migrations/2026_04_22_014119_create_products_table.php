<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('products');

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Harus UnsignedBigInteger karena 'id_umkm' juga tipe BigInt
            $table->unsignedBigInteger('umkm_id'); 
            
            $table->string('nama_produk');
            $table->integer('harga');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            // PERBAIKAN: Referensi ke 'id_umkm' di tabel 'umkm'
            $table->foreign('umkm_id')
                  ->references('id_umkm')
                  ->on('umkm') // Sesuai nama tabel di file yang kamu kirim
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};