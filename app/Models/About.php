<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'sejarah', 
        'visi', 
        'misi', 
        'luas_wilayah', 
        'jumlah_penduduk'
    ];
}