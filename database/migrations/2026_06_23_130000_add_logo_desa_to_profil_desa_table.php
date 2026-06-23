<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_desa', function (Blueprint $table) {
            if (! Schema::hasColumn('profil_desa', 'logo_desa')) {
                $table->string('logo_desa', 191)->nullable()->after('foto_kegiatan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('profil_desa', function (Blueprint $table) {
            if (Schema::hasColumn('profil_desa', 'logo_desa')) {
                $table->dropColumn('logo_desa');
            }
        });
    }
};
