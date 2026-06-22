<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galeri_fotos', function (Blueprint $table) {
            $table->id('id_galeri_foto');
            $table->unsignedBigInteger('id_galeri');
            $table->string('foto_path');
            $table->timestamps();

            $table->foreign('id_galeri')
                ->references('id_galeri')
                ->on('galeri')
                ->onDelete('cascade');
        });

        // Migrate existing data
        $galeris = DB::table('galeri')->get();
        foreach ($galeris as $g) {
            if (!empty($g->gambar_galeri)) {
                DB::table('galeri_fotos')->insert([
                    'id_galeri' => $g->id_galeri,
                    'foto_path' => $g->gambar_galeri,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeri_fotos');
    }
};
