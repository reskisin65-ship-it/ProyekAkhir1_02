<?php
// database/migrations/2024_xx_xx_xxxxxx_add_nip_to_data_pengurus_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('data_pengurus', function (Blueprint $table) {
            if (!Schema::hasColumn('data_pengurus', 'nip')) {
                $table->string('nip', 50)->nullable()->after('jabatan');
            }
            if (!Schema::hasColumn('data_pengurus', 'tugas')) {
                $table->text('tugas')->nullable()->after('nip');
            }
            if (!Schema::hasColumn('data_pengurus', 'urutan')) {
                $table->integer('urutan')->default(0)->after('tugas');
            }
        });
    }

    public function down()
    {
        Schema::table('data_pengurus', function (Blueprint $table) {
            $table->dropColumn(['nip', 'tugas', 'urutan']);
        });
    }
};