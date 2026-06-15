<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

/**
 * Sinkronisasi struktur database agar sesuai CDM/PDM.
 * Semua perubahan menggunakan hasColumn / hasTable check
 * sehingga aman dijalankan meskipun sebagian kolom sudah ada.
 */
return new class extends Migration
{
    public function up(): void
    {
        // =====================================================================
        // 1. TABEL: users
        //    PDM: id, id_role, name, email, password, nomor_telepon,
        //         alamat, foto_profil, remember_token, timestamps
        // =====================================================================
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nomor_telepon')) {
                $table->string('nomor_telepon', 20)->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable()->after('nomor_telepon');
            }
            if (!Schema::hasColumn('users', 'foto_profil')) {
                $table->string('foto_profil', 255)->nullable()->after('alamat');
            }
        });

        // =====================================================================
        // 2. TABEL: berita
        //    PDM: id_berita, user_id, judul, slug, isi, ringkasan, kategori,
        //         gambar, tanggal_publikasi, status, foto, dibaca,
        //         created_at, updated_at
        // =====================================================================
        Schema::table('berita', function (Blueprint $table) {
            if (!Schema::hasColumn('berita', 'slug')) {
                $table->string('slug', 255)->nullable()->unique()->after('judul');
            }
            if (!Schema::hasColumn('berita', 'ringkasan')) {
                $table->text('ringkasan')->nullable()->after('isi_berita');
            }
            if (!Schema::hasColumn('berita', 'gambar')) {
                $table->string('gambar', 191)->nullable()->after('kategori');
            }
            if (!Schema::hasColumn('berita', 'tanggal_publikasi')) {
                $table->dateTime('tanggal_publikasi')->nullable()->after('status');
            }
            if (!Schema::hasColumn('berita', 'dibaca')) {
                $table->integer('dibaca')->default(0)->after('tanggal_publikasi');
            }
        });

        // =====================================================================
        // 3. TABEL: aspirasi
        //    PDM: id_aspirasi, user_id, judul, isi_aspirasi, kategori,
        //         status, respon_admin, lampiran, created_at, updated_at
        //    Catatan: id_pengurus TIDAK ada di PDM (relasi langsung ke user)
        // =====================================================================
        Schema::table('aspirasi', function (Blueprint $table) {
            if (!Schema::hasColumn('aspirasi', 'judul')) {
                $table->string('judul', 255)->after('user_id');
            }
            if (!Schema::hasColumn('aspirasi', 'lampiran')) {
                $table->string('lampiran', 255)->nullable()->after('status');
            }
            if (!Schema::hasColumn('aspirasi', 'respon_admin')) {
                $table->text('respon_admin')->nullable()->after('lampiran');
            }
        });

        // =====================================================================
        // 4. TABEL: pengajuan_surat
        //    PDM: id_surat, user_id, jenis_surat, nama_lengkap, nik,
        //         tempat_lahir, tanggal_lahir, nomor_telepon, keperluan,
        //         keterangan, berkas_pendukung, status, catatan_penolakan,
        //         file_surat, tgl_pengajuan, id_pengurus, created_at, updated_at
        // =====================================================================
        Schema::table('pengajuan_surat', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_surat', 'keterangan')) {
                $table->text('keterangan')->nullable()->after('keperluan');
            }
            if (!Schema::hasColumn('pengajuan_surat', 'id_pengurus')) {
                $table->unsignedBigInteger('id_pengurus')->nullable()->after('user_id');
                $table->foreign('id_pengurus')
                      ->references('id_pengurus')
                      ->on('data_pengurus')
                      ->onDelete('set null');
            }
        });

        // =====================================================================
        // 5. TABEL: umkm
        //    PDM: id_umkm, user_id, nama_usaha, kategori, pemilik,
        //         no_telepon, alamat_usaha, deskripsi, logo, bukti_usaha,
        //         status, created_at, updated_at
        //    Sudah sesuai — tidak ada perubahan
        // =====================================================================

        // =====================================================================
        // 6. TABEL: produk_umkm
        //    PDM: id_produk, user_id, umkm_id, nama_produk, deskripsi,
        //         harga, foto_produk, created_at, updated_at
        //    Catatan: kolom stok tidak ada di PDM
        // =====================================================================
        Schema::table('produk_umkm', function (Blueprint $table) {
            if (!Schema::hasColumn('produk_umkm', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id_produk');
                $table->foreign('user_id')
                      ->references('user_id')
                      ->on('users')
                      ->onDelete('set null');
            }
        });

        // =====================================================================
        // 7. TABEL: galeri
        //    PDM: id_galeri, user_id, judul_galeri, gambar_galeri,
        //         kategori, deskripsi, created_at, updated_at
        // =====================================================================
        Schema::table('galeri', function (Blueprint $table) {
            if (!Schema::hasColumn('galeri', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id_galeri');
                $table->foreign('user_id')
                      ->references('user_id')
                      ->on('users')
                      ->onDelete('set null');
            }
            if (!Schema::hasColumn('galeri', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('kategori');
            }
        });

        // =====================================================================
        // 8. TABEL: data_pengurus
        //    PDM: id_pengurus, user_id, nama_pengurus, jabatan,
        //         kategori_jabatan, urutan_dalam_kategori, nip, tugas,
        //         foto, level, created_at, updated_at
        //    Sudah sesuai dari migration sebelumnya — tidak ada perubahan
        // =====================================================================

        // =====================================================================
        // 9. TABEL: data_penduduk
        //    PDM: id_penduduk, user_id, nik, nama_lengkap, jenis_kelamin,
        //         tempat_lahir, tanggal_lahir, agama, pendidikan, pekerjaan,
        //         status_perkawinan, alamat, rt_rw, kelurahan_desa, kecamatan,
        //         kabupaten_kota, provinsi, status_keluarga, no_kk, foto_ktp,
        //         created_at, updated_at
        //    Sudah sesuai — tidak ada perubahan
        // =====================================================================

        // =====================================================================
        // 10. TABEL: kategori_keuangan
        //     PDM: id_kategori, user_id, nama_kategori, jenis, icon,
        //          warna, urutan, is_active, created_at, updated_at
        // =====================================================================
        Schema::table('kategori_keuangan', function (Blueprint $table) {
            if (!Schema::hasColumn('kategori_keuangan', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id_kategori');
                $table->foreign('user_id')
                      ->references('user_id')
                      ->on('users')
                      ->onDelete('set null');
            }
        });

        // =====================================================================
        // 11. TABEL: transaksi_keuangan
        //     PDM: id_transaksi, id_kategori, tanggal, jenis, deskripsi,
        //          jumlah, bukti_foto, status, created_by, approved_by,
        //          catatan_admin, created_at, updated_at
        //     Sudah sesuai — dua FK ke users (created_by, approved_by) BENAR
        // =====================================================================

        // =====================================================================
        // 12. TABEL: profil_desa
        //     PDM: id, user_id, sejarah, visi, misi, foto_kantor,
        //          foto_kegiatan, luas_wilayah, kecamatan, kabupaten,
        //          provinsi, tahun_berdiri, jumlah_dusun, alamat_kantor,
        //          email_desa, telepon_desa, maps_embed, created_at, updated_at
        // =====================================================================
        Schema::table('profil_desa', function (Blueprint $table) {
            if (!Schema::hasColumn('profil_desa', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')
                      ->references('user_id')
                      ->on('users')
                      ->onDelete('set null');
            }
        });

        // =====================================================================
        // 13. TABEL: kontak_desas (nama tabel sesuai migration yang ada)
        //     PDM: id, user_id, nama, jabatan, bidang, no_hp, email,
        //          foto, urutan, is_active, created_at, updated_at
        // =====================================================================
        Schema::table('kontak_desas', function (Blueprint $table) {
            if (!Schema::hasColumn('kontak_desas', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')
                      ->references('user_id')
                      ->on('users')
                      ->onDelete('set null');
            }
        });

        // =====================================================================
        // 14. TABEL: notifikasi
        //     PDM: id, user_id, jenis, judul, pesan, link, ref_id,
        //          dibaca, created_at, updated_at
        //     Sudah sesuai — tidak ada perubahan
        // =====================================================================

        // =====================================================================
        // 15. TABEL: roles
        //     PDM: id_role, nama_role, updated_at
        //     Sudah sesuai — tidak ada perubahan
        // =====================================================================
    }

    public function down(): void
    {
        // Hapus FK dan kolom yang ditambahkan, urutan terbalik

        // pengajuan_surat.id_pengurus
        if (Schema::hasColumn('pengajuan_surat', 'id_pengurus')) {
            Schema::table('pengajuan_surat', function (Blueprint $table) {
                $table->dropForeign(['id_pengurus']);
                $table->dropColumn('id_pengurus');
            });
        }
        if (Schema::hasColumn('pengajuan_surat', 'keterangan')) {
            Schema::table('pengajuan_surat', function (Blueprint $table) {
                $table->dropColumn('keterangan');
            });
        }

        // produk_umkm.user_id
        if (Schema::hasColumn('produk_umkm', 'user_id')) {
            Schema::table('produk_umkm', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }

        // galeri.user_id, deskripsi
        if (Schema::hasColumn('galeri', 'user_id')) {
            Schema::table('galeri', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
        if (Schema::hasColumn('galeri', 'deskripsi')) {
            Schema::table('galeri', function (Blueprint $table) {
                $table->dropColumn('deskripsi');
            });
        }

        // kategori_keuangan.user_id
        if (Schema::hasColumn('kategori_keuangan', 'user_id')) {
            Schema::table('kategori_keuangan', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }

        // profil_desa.user_id
        if (Schema::hasColumn('profil_desa', 'user_id')) {
            Schema::table('profil_desa', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }

        // kontak_desas.user_id
        if (Schema::hasColumn('kontak_desas', 'user_id')) {
            Schema::table('kontak_desas', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }

        // berita columns
        Schema::table('berita', function (Blueprint $table) {
            $cols = ['slug', 'ringkasan', 'gambar', 'tanggal_publikasi', 'dibaca'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('berita', $col)) {
                    $table->dropColumn($col);
                }
            }
        });

        // users columns
        Schema::table('users', function (Blueprint $table) {
            foreach (['nomor_telepon', 'alamat', 'foto_profil'] as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
