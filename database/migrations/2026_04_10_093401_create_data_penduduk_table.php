<?php
// database/migrations/2025_01_01_000005_create_data_penduduk_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_penduduk', function (Blueprint $table) {
            $table->id('id_penduduk');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->string('agama', 20);
            $table->string('pendidikan', 50);
            $table->string('pekerjaan', 50);
            $table->string('status_perkawinan', 20);
            $table->text('alamat');
            $table->string('rt_rw', 10);
            $table->string('kelurahan_desa', 50);
            $table->string('kecamatan', 50);
            $table->string('kabupaten_kota', 50);
            $table->string('provinsi', 50);
            $table->string('status_keluarga', 30);
            $table->string('no_kk', 20)->nullable();
            $table->string('foto_ktp', 191)->nullable();
            $table->timestamps();
            
            // Foreign key ke users.user_id
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_penduduk');
    }
};