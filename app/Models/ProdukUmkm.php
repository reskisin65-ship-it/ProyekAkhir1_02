<?php
// app/Models/ProdukUmkm.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukUmkm extends Model
{
    protected $table = 'produk_umkm';
    protected $primaryKey = 'id_produk';
    
    protected $fillable = [
        'umkm_id', 'nama_produk', 'deskripsi', 'harga', 'foto_produk', 'stok'
    ];
    
    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id_umkm');
    }
}