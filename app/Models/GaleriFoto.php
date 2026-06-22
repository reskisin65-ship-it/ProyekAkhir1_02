<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    protected $table = 'galeri_fotos';
    protected $primaryKey = 'id_galeri_foto';
    
    protected $fillable = [
        'id_galeri', 'foto_path'
    ];

    public function galeri()
    {
        return $this->belongsTo(Galeri::class, 'id_galeri', 'id_galeri');
    }
    
    public function getFotoUrlAttribute()
    {
        return asset('storage/' . $this->foto_path);
    }
}
