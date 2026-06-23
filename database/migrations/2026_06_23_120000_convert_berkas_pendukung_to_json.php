<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $rows = DB::table('pengajuan_surat')
            ->whereNotNull('berkas_pendukung')
            ->where('berkas_pendukung', '!=', '')
            ->get(['id_surat', 'berkas_pendukung']);

        foreach ($rows as $row) {
            $value = $row->berkas_pendukung;
            if (! str_starts_with($value, '[')) {
                DB::table('pengajuan_surat')
                    ->where('id_surat', $row->id_surat)
                    ->update(['berkas_pendukung' => json_encode([$value])]);
            }
        }

        DB::statement('ALTER TABLE pengajuan_surat MODIFY berkas_pendukung TEXT NULL');
    }

    public function down(): void
    {
        $rows = DB::table('pengajuan_surat')
            ->whereNotNull('berkas_pendukung')
            ->get(['id_surat', 'berkas_pendukung']);

        foreach ($rows as $row) {
            $decoded = json_decode($row->berkas_pendukung, true);
            $first = is_array($decoded) ? ($decoded[0] ?? null) : $row->berkas_pendukung;
            DB::table('pengajuan_surat')
                ->where('id_surat', $row->id_surat)
                ->update(['berkas_pendukung' => $first]);
        }

        DB::statement('ALTER TABLE pengajuan_surat MODIFY berkas_pendukung VARCHAR(191) NULL');
    }
};
