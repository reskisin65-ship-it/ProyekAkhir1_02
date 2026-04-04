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
    Schema::create('beritas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users'); // Penulis (Admin)
        $table->string('judul', 191);
        $table->text('isi_berita');
        $table->string('foto', 255)->nullable();
        $table->string('kategori', 50);
        $table->enum('status', ['draft', 'publik'])->default('publik');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
