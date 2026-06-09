<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            if (!Schema::hasColumn('galeri', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('kategori');
            }
        });
    }

    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            if (Schema::hasColumn('galeri', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
        });
    }
};
