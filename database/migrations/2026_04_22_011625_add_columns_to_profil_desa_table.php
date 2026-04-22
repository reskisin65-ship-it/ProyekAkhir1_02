<?php
// database/migrations/2024_xx_xx_xxxxxx_add_columns_to_profil_desa_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profil_desa', function (Blueprint $table) {
            // Cek dan tambahkan kolom jika belum ada
            if (!Schema::hasColumn('profil_desa', 'kecamatan')) {
                $table->string('kecamatan')->nullable()->after('luas_wilayah');
            }
            if (!Schema::hasColumn('profil_desa', 'kabupaten')) {
                $table->string('kabupaten')->nullable()->after('kecamatan');
            }
            if (!Schema::hasColumn('profil_desa', 'provinsi')) {
                $table->string('provinsi')->nullable()->after('kabupaten');
            }
            if (!Schema::hasColumn('profil_desa', 'tahun_berdiri')) {
                $table->string('tahun_berdiri')->nullable()->after('provinsi');
            }
            if (!Schema::hasColumn('profil_desa', 'jumlah_dusun')) {
                $table->integer('jumlah_dusun')->default(0)->after('tahun_berdiri');
            }
            if (!Schema::hasColumn('profil_desa', 'alamat_kantor')) {
                $table->text('alamat_kantor')->nullable()->after('jumlah_dusun');
            }
            if (!Schema::hasColumn('profil_desa', 'email_desa')) {
                $table->string('email_desa')->nullable()->after('alamat_kantor');
            }
            if (!Schema::hasColumn('profil_desa', 'telepon_desa')) {
                $table->string('telepon_desa')->nullable()->after('email_desa');
            }
            if (!Schema::hasColumn('profil_desa', 'maps_embed')) {
                $table->text('maps_embed')->nullable()->after('telepon_desa');
            }
            if (!Schema::hasColumn('profil_desa', 'foto_kantor')) {
                $table->string('foto_kantor')->nullable()->after('maps_embed');
            }
            if (!Schema::hasColumn('profil_desa', 'foto_kegiatan')) {
                $table->string('foto_kegiatan')->nullable()->after('foto_kantor');
            }
        });
    }

    public function down()
    {
        Schema::table('profil_desa', function (Blueprint $table) {
            $columns = ['kecamatan', 'kabupaten', 'provinsi', 'tahun_berdiri', 'jumlah_dusun', 
                        'alamat_kantor', 'email_desa', 'telepon_desa', 'maps_embed', 
                        'foto_kantor', 'foto_kegiatan'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('profil_desa', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};