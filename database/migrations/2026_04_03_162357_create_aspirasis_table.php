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
    Schema::create('aspirasis', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('kategori', 50); // Contoh: Kebersihan, Infrastruktur
        $table->text('isi_aspirasi');
        $table->string('status', 20)->default('baru'); // baru, ditanggapi
        $table->string('lampiran', 255)->nullable(); // Foto pendukung
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};
