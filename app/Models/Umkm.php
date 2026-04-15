<?php
// app/Models/Umkm.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $table = 'umkm';
    protected $primaryKey = 'id_umkm';
    
    protected $fillable = [
        'user_id', 'nama_usaha', 'kategori', 'pemilik', 'no_telepon',
        'alamat_usaha', 'deskripsi', 'logo', 'bukti_usaha', 'status'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    
    public function produk()
    {
        return $this->hasMany(ProdukUmkm::class, 'umkm_id', 'id_umkm');
    }
}