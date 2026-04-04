<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    protected $fillable = ['user_id', 'nik', 'jenis_surat', 'keperluan', 'status', 'tgl_pengajuan', 'nama_berkas'];

public function user() {
    return $this->belongsTo(User::class);
}
}
