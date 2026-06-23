<?php
// app/Models/PengajuanSurat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    protected $table = 'pengajuan_surat';
    protected $primaryKey = 'id_surat';
    
    protected $fillable = [
        'user_id',
        'jenis_surat',
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'nomor_telepon',
        'keperluan',
        'keterangan',
        'berkas_pendukung',
        'status',
        'catatan_penolakan',
        'file_surat',
        'nomor_surat',
        'file_surat_draft',
        'tgl_pengajuan'
    ];
    
    protected $casts = [
        'tgl_pengajuan' => 'date',
        'tanggal_lahir' => 'date',
        'berkas_pendukung' => 'array',
    ];

    public function getBerkasPendukungList(): array
    {
        $berkas = $this->berkas_pendukung;

        if (is_array($berkas)) {
            return array_values(array_filter($berkas));
        }

        if (is_string($berkas) && $berkas !== '') {
            return [$berkas];
        }

        return [];
    }

    public function hasBerkasPendukung(): bool
    {
        return count($this->getBerkasPendukungList()) > 0;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}