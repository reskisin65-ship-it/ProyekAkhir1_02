<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Tambah kolom ringkasan
        if (!Schema::hasColumn('berita', 'ringkasan')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->text('ringkasan')->nullable()->after('isi_berita');
            });
        }

        // Tambah kolom tanggal_publikasi
        if (!Schema::hasColumn('berita', 'tanggal_publikasi')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->datetime('tanggal_publikasi')->nullable()->after('status');
            });
        }

        // Tambah kolom dibaca
        if (!Schema::hasColumn('berita', 'dibaca')) {
            Schema::table('berita', function (Blueprint $table) {
                $table->integer('dibaca')->default(0)->after('tanggal_publikasi');
            });
        }

        // Isi ringkasan dari isi_berita untuk data lama
        if (Schema::hasColumn('berita', 'ringkasan') && Schema::hasColumn('berita', 'isi_berita')) {
            DB::table('berita')->whereNull('ringkasan')->update([
                'ringkasan' => DB::raw('SUBSTRING(isi_berita, 1, 150)')
            ]);
        }

        // Isi tanggal_publikasi dengan created_at untuk data lama
        if (Schema::hasColumn('berita', 'tanggal_publikasi')) {
            DB::table('berita')->whereNull('tanggal_publikasi')->update([
                'tanggal_publikasi' => DB::raw('created_at')
            ]);
        }

        // Isi slug untuk data yang null
        if (Schema::hasColumn('berita', 'slug')) {
            $beritas = DB::table('berita')->whereNull('slug')->get();
            foreach ($beritas as $berita) {
                DB::table('berita')
                    ->where('id_berita', $berita->id_berita)
                    ->update(['slug' => Str::slug($berita->judul) . '-' . $berita->id_berita]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn(['ringkasan', 'tanggal_publikasi', 'dibaca']);
        });
    }
};