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
        // 1. profil_desa
        if (Schema::hasTable('profil_desa') && !Schema::hasColumn('profil_desa', 'user_id')) {
            Schema::table('profil_desa', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')
                      ->references('user_id')
                      ->on('users')
                      ->onDelete('set null');
            });
        }

        // 2. kategori_keuangan
        if (Schema::hasTable('kategori_keuangan') && !Schema::hasColumn('kategori_keuangan', 'user_id')) {
            Schema::table('kategori_keuangan', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id_kategori');
                $table->foreign('user_id')
                      ->references('user_id')
                      ->on('users')
                      ->onDelete('set null');
            });
        }

        // 3. galeri
        if (Schema::hasTable('galeri') && !Schema::hasColumn('galeri', 'user_id')) {
            Schema::table('galeri', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id_galeri');
                $table->foreign('user_id')
                      ->references('user_id')
                      ->on('users')
                      ->onDelete('set null');
            });
        }

        // 4. kontak_desas
        if (Schema::hasTable('kontak_desas') && !Schema::hasColumn('kontak_desas', 'user_id')) {
            Schema::table('kontak_desas', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
                $table->foreign('user_id')
                      ->references('user_id')
                      ->on('users')
                      ->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. profil_desa
        if (Schema::hasTable('profil_desa') && Schema::hasColumn('profil_desa', 'user_id')) {
            Schema::table('profil_desa', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }

        // 2. kategori_keuangan
        if (Schema::hasTable('kategori_keuangan') && Schema::hasColumn('kategori_keuangan', 'user_id')) {
            Schema::table('kategori_keuangan', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }

        // 3. galeri
        if (Schema::hasTable('galeri') && Schema::hasColumn('galeri', 'user_id')) {
            Schema::table('galeri', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }

        // 4. kontak_desas
        if (Schema::hasTable('kontak_desas') && Schema::hasColumn('kontak_desas', 'user_id')) {
            Schema::table('kontak_desas', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }
};
