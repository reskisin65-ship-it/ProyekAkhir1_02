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
        if (Schema::hasTable('produk_umkm') && !Schema::hasColumn('produk_umkm', 'user_id')) {
            Schema::table('produk_umkm', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id_produk');
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
        if (Schema::hasTable('produk_umkm') && Schema::hasColumn('produk_umkm', 'user_id')) {
            Schema::table('produk_umkm', function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }
};
