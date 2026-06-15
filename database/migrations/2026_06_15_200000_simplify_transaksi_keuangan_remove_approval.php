<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Set semua transaksi jadi status aktif sebelum hapus kolom
        DB::table('transaksi_keuangan')->update(['status' => 'disetujui']);

        Schema::table('transaksi_keuangan', function (Blueprint $table) {
            // Hapus FK approved_by dulu
            $table->dropForeign(['approved_by']);
            $table->dropColumn(['status', 'approved_by', 'catatan_admin']);
        });
    }

    public function down(): void
    {
        Schema::table('transaksi_keuangan', function (Blueprint $table) {
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending')->after('bukti_foto');
            $table->unsignedBigInteger('approved_by')->nullable()->after('created_by');
            $table->text('catatan_admin')->nullable()->after('approved_by');
            $table->foreign('approved_by')->references('user_id')->on('users');
        });
    }
};
