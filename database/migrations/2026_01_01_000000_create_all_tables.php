<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration tunggal yang membangun semua tabel dari awal.
 * Menggantikan semua migration lama yang terpisah-pisah.
 */
return new class extends Migration
{
    public function up(): void
    {
        // =====================================================================
        // 1. roles
        // =====================================================================
        Schema::create('roles', function (Blueprint $table) {
            $table->id('id_role');
            $table->string('nama_role', 50);
            $table->timestamps();
        });

        // =====================================================================
        // 2. users
        // =====================================================================
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->unsignedBigInteger('id_role');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('nomor_telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto_profil', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_role')
                ->references('id_role')
                ->on('roles')
                ->onDelete('restrict');
        });

        // =====================================================================
        // 3. sessions
        // =====================================================================
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        // =====================================================================
        // 4. cache
        // =====================================================================
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

        // =====================================================================
        // 5. profil_desa
        // =====================================================================
        Schema::create('profil_desa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('sejarah')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('foto_kantor')->nullable();
            $table->string('foto_kegiatan')->nullable();
            $table->string('luas_wilayah')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('tahun_berdiri')->nullable();
            $table->integer('jumlah_dusun')->default(0);
            $table->text('alamat_kantor')->nullable();
            $table->string('email_desa')->nullable();
            $table->string('telepon_desa')->nullable();
            $table->text('maps_embed')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('set null');
        });

        // =====================================================================
        // 6. data_pengurus (skema final: tanpa deskripsi, dengan kolom lengkap)
        // =====================================================================
        Schema::create('data_pengurus', function (Blueprint $table) {
            $table->id('id_pengurus');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_pengurus', 100);
            $table->string('jabatan', 50);
            $table->string('nip', 50)->nullable();
            $table->text('tugas')->nullable();
            $table->string('kategori_jabatan', 50)->default('lainnya');
            $table->integer('level')->default(99);
            $table->integer('urutan_dalam_kategori')->default(0);
            $table->integer('urutan')->default(0);
            $table->string('foto', 191)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('set null');
        });

        // =====================================================================
        // 7. data_penduduk
        // =====================================================================
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

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('set null');
        });

        // =====================================================================
        // 8. pengajuan_surat
        // =====================================================================
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->id('id_surat');
            $table->unsignedBigInteger('user_id');
            $table->string('jenis_surat', 50);
            $table->string('nama_lengkap', 100);
            $table->string('nik', 16);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->string('nomor_telepon', 15);
            $table->text('keperluan');
            $table->text('keterangan')->nullable();
            $table->string('berkas_pendukung', 191)->nullable();
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('catatan_penolakan')->nullable();
            $table->string('file_surat', 191)->nullable();
            $table->date('tgl_pengajuan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');
        });

        // =====================================================================
        // 9. aspirasi
        // =====================================================================
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->id('id_aspirasi');
            $table->unsignedBigInteger('user_id');
            $table->string('judul', 255);
            $table->text('isi_aspirasi');
            $table->text('respon_admin')->nullable();
            $table->enum('kategori', ['saran', 'keluhan', 'masukan', 'pertanyaan'])->default('saran');
            $table->enum('status', ['baru', 'diproses', 'selesai'])->default('baru');
            $table->string('lampiran')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');
            $table->index('status');
            $table->index('kategori');
        });

        // =====================================================================
        // 10. umkm
        // =====================================================================
        Schema::create('umkm', function (Blueprint $table) {
            $table->id('id_umkm');
            $table->unsignedBigInteger('user_id');
            $table->string('nama_usaha');
            $table->string('kategori');
            $table->string('pemilik');
            $table->string('no_telepon', 15);
            $table->text('alamat_usaha');
            $table->text('deskripsi');
            $table->string('logo')->nullable();
            $table->string('bukti_usaha')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');
        });

        // =====================================================================
        // 11. produk_umkm
        // =====================================================================
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
                ->references('user_id')
                ->on('users')
                ->onDelete('set null');
            $table->foreign('umkm_id')
                ->references('id_umkm')
                ->on('umkm')
                ->onDelete('cascade');
        });

        // =====================================================================
        // 12. products (tabel terpisah yang dipakai oleh beberapa controller)
        // =====================================================================
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('umkm_id');
            $table->string('nama_produk');
            $table->decimal('harga', 12, 0)->default(0);
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('umkm_id')
                ->references('id_umkm')
                ->on('umkm')
                ->onDelete('cascade');
        });

        // =====================================================================
        // 13. berita (skema final: dengan semua kolom)
        // =====================================================================
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->unsignedBigInteger('user_id');
            $table->string('judul', 191);
            $table->string('slug', 255)->nullable()->unique();
            $table->text('ringkasan')->nullable();
            $table->text('isi_berita');
            $table->string('kategori', 30);
            $table->string('foto', 191)->nullable();
            $table->string('gambar', 191)->nullable();
            $table->date('tanggal_publikasi')->nullable();
            $table->integer('dibaca')->default(0);
            $table->string('status', 20)->default('draft');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');
        });

        // =====================================================================
        // 14. galeri
        // =====================================================================
        Schema::create('galeri', function (Blueprint $table) {
            $table->id('id_galeri');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('judul_galeri', 50);
            $table->string('gambar_galeri', 191);
            $table->string('kategori', 30);
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('set null');
        });

        // =====================================================================
        // 15. kategori_keuangan
        // =====================================================================
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
                ->references('user_id')
                ->on('users')
                ->onDelete('set null');
        });

        // =====================================================================
        // 16. transaksi_keuangan (skema final: tanpa approval)
        // =====================================================================
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
                ->references('id_kategori')
                ->on('kategori_keuangan')
                ->onDelete('restrict');
            $table->foreign('created_by')
                ->references('user_id')
                ->on('users')
                ->onDelete('restrict');
            $table->index('tanggal');
            $table->index('jenis');
        });

        // =====================================================================
        // 17. notifikasi
        // =====================================================================
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('jenis')->default('umum');
            $table->string('judul');
            $table->text('pesan');
            $table->string('link')->nullable();
            $table->unsignedBigInteger('ref_id')->nullable();
            $table->boolean('dibaca')->default(false);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');
            $table->index(['user_id', 'dibaca']);
        });

        // =====================================================================
        // 18. kontak_desas
        // =====================================================================
        Schema::create('kontak_desas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('bidang')->nullable();
            $table->string('no_hp');
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Urutan drop terbalik dari urutan create (child dulu baru parent)
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('kontak_desas');
        Schema::dropIfExists('notifikasi');
        Schema::dropIfExists('transaksi_keuangan');
        Schema::dropIfExists('kategori_keuangan');
        Schema::dropIfExists('galeri');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('products');
        Schema::dropIfExists('produk_umkm');
        Schema::dropIfExists('umkm');
        Schema::dropIfExists('aspirasi');
        Schema::dropIfExists('pengajuan_surat');
        Schema::dropIfExists('data_penduduk');
        Schema::dropIfExists('data_pengurus');
        Schema::dropIfExists('profil_desa');
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');

        Schema::enableForeignKeyConstraints();
    }
};
