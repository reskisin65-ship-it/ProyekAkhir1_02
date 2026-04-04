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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            // Ditujukan ke user siapa
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('judul', 100);
            $table->text('pesan');
            $table->boolean('is_read')->default(false); // Untuk menandai sudah dibaca atau belum
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};