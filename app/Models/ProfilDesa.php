<?php
// app/Models/ProfilDesa.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilDesa extends Model
{
    use HasFactory;
    
    protected $table = 'profil_desa';
    
    protected $fillable = [
        'sejarah',
        'visi',
        'misi',
        'foto_kantor',
        'foto_kegiatan',
        'luas_wilayah',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'tahun_berdiri',
        'jumlah_dusun',
        'alamat_kantor',
        'email_desa',
        'telepon_desa',
        'maps_embed'
    ];
}