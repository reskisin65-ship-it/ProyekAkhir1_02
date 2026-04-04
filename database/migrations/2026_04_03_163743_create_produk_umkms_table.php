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
    Schema::create('produk_umkms', function (Blueprint $table) {
        $table->id();
        $table->foreignId('umkm_id')->constrained('umkms')->onDelete('cascade');
        $table->string('nama_produk', 100);
        $table->integer('harga');
        $table->string('foto_produk', 255)->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_umkms');
    }
};
