<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('data_penduduks', function (Blueprint $table) {
            // NIK sebagai Primary Key (Gunakan string agar tidak error angka terlalu besar)
            $table->string('nik', 20)->primary(); 
            
            // Relasi 1:1 ke tabel users. 
            // unique() memastikan 1 NIK hanya punya 1 akun, dan 1 akun hanya punya 1 NIK.
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            
            $table->string('nama_lengkap', 100);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('data_penduduks');
    }
};