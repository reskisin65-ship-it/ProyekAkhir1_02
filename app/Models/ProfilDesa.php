<?php
// app/Models/ProfilDesa.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $table = 'profil_desa';
    protected $primaryKey = 'id_profil';
    
    protected $fillable = [
        'sejarah', 'visi', 'misi', 'luas_wilayah', 'jumlah_penduduk',
        'foto_kantor', 'foto_kegiatan'
    ];
}