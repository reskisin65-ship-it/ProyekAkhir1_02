<?php
// app/Models/DataPenduduk.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPenduduk extends Model
{
    protected $table = 'data_penduduk';
    protected $primaryKey = 'id_penduduk';
    
    protected $fillable = [
        'user_id', 'nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir',
        'tanggal_lahir', 'agama', 'pendidikan', 'pekerjaan', 'status_perkawinan',
        'alamat', 'rt_rw', 'kelurahan_desa', 'kecamatan', 'kabupaten_kota',
        'provinsi', 'status_keluarga', 'no_kk', 'foto_ktp'
    ];
    
    protected $casts = [
        'tanggal_lahir' => 'date'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}