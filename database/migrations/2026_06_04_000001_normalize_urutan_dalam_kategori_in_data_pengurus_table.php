<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('data_pengurus', 'urutan_dalam_kategori')) {
            return;
        }

        $rows = DB::table('data_pengurus')
            ->orderBy('kategori_jabatan')
            ->orderBy('urutan')
            ->orderBy('id_pengurus')
            ->get(['id_pengurus', 'kategori_jabatan', 'urutan', 'urutan_dalam_kategori']);

        $nextPosition = [];
        $assigned = [];

        foreach ($rows as $row) {
            $kategori = $row->kategori_jabatan ?: 'lainnya';

            if (!isset($nextPosition[$kategori])) {
                $nextPosition[$kategori] = 1;
                $assigned[$kategori] = [];
            }

            if ($row->urutan_dalam_kategori > 0) {
                $assigned[$kategori][$row->urutan_dalam_kategori] = true;
                $nextPosition[$kategori] = max($nextPosition[$kategori], $row->urutan_dalam_kategori + 1);
                continue;
            }

            if ($row->urutan > 0 && !isset($assigned[$kategori][$row->urutan])) {
                $position = $row->urutan;
            } else {
                while (isset($assigned[$kategori][$nextPosition[$kategori]])) {
                    $nextPosition[$kategori]++;
                }
                $position = $nextPosition[$kategori];
            }

            DB::table('data_pengurus')
                ->where('id_pengurus', $row->id_pengurus)
                ->update(['urutan_dalam_kategori' => $position]);

            $assigned[$kategori][$position] = true;
            $nextPosition[$kategori] = max($nextPosition[$kategori], $position + 1);
        }
    }

    public function down(): void
    {
        // Nothing to rollback safely.
    }
};
