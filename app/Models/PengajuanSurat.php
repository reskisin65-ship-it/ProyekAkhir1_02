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
        'tgl_pengajuan'
    ];
    
    protected $casts = [
        'tgl_pengajuan' => 'date',
        'tanggal_lahir' => 'date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}