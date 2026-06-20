<?php
// app/Models/ProdukUmkm.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukUmkm extends Model
{
    protected $table = 'produk_umkm';
    protected $primaryKey = 'id_produk';
    
    protected $fillable = [
        'user_id', 'umkm_id', 'nama_produk', 'deskripsi', 'harga', 'foto_produk'
    ];

    protected $casts = [
        'harga' => 'integer',
    ];
    
    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id_umkm');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}