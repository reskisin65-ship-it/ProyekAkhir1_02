<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_pengurus', function (Blueprint $table) {
            if (!Schema::hasColumn('data_pengurus', 'kategori_jabatan')) {
                $table->string('kategori_jabatan', 50)->default('lainnya')->after('jabatan');
            }
            if (!Schema::hasColumn('data_pengurus', 'level')) {
                $table->integer('level')->default(99)->after('kategori_jabatan');
            }
            if (!Schema::hasColumn('data_pengurus', 'urutan_dalam_kategori')) {
                $table->integer('urutan_dalam_kategori')->default(0)->after('level');
            }
        });

        if (Schema::hasColumn('data_pengurus', 'kategori_jabatan')) {
            DB::table('data_pengurus')
                ->whereNull('kategori_jabatan')
                ->update(['kategori_jabatan' => 'lainnya']);
        }

        if (Schema::hasColumn('data_pengurus', 'level')) {
            DB::table('data_pengurus')
                ->whereNull('level')
                ->update(['level' => 99]);
        }

        if (Schema::hasColumn('data_pengurus', 'urutan_dalam_kategori')) {
            if (Schema::hasColumn('data_pengurus', 'urutan')) {
                DB::table('data_pengurus')
                    ->whereNull('urutan_dalam_kategori')
                    ->update(['urutan_dalam_kategori' => DB::raw('urutan')]);
            } else {
                DB::table('data_pengurus')
                    ->whereNull('urutan_dalam_kategori')
                    ->update(['urutan_dalam_kategori' => 0]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('data_pengurus', function (Blueprint $table) {
            if (Schema::hasColumn('data_pengurus', 'urutan_dalam_kategori')) {
                $table->dropColumn('urutan_dalam_kategori');
            }
            if (Schema::hasColumn('data_pengurus', 'level')) {
                $table->dropColumn('level');
            }
            if (Schema::hasColumn('data_pengurus', 'kategori_jabatan')) {
                $table->dropColumn('kategori_jabatan');
            }
        });
    }
};
