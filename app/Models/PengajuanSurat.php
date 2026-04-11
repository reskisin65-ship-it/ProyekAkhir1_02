<?php
// app/Models/PengajuanSurat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    protected $table = 'pengajuan_surat';
    protected $primaryKey = 'id_surat';
    
    protected $fillable = [
        'user_id', 'jenis_surat', 'nik', 'status', 'berkas', 'tgl_pengajuan'
    ];
    
    protected $casts = [
        'tgl_pengajuan' => 'date'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}