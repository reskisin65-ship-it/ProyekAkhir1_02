<?php
// app/Models/Galeri.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id_galeri';
    
    protected $fillable = [
        'judul_galeri', 'gambar_galeri', 'kategori'
    ];
    
    // Optional: tambahkan accessor untuk mendapatkan URL foto
    public function getFotoUrlAttribute()
    {
        return asset('storage/' . $this->gambar_galeri);
    }
    
    // Optional: format tanggal
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}