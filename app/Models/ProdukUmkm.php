<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukUmkm extends Model
{
    protected $fillable = ['umkm_id', 'nama_produk', 'harga', 'foto_produk'];

public function umkm() {
    return $this->belongsTo(Umkm::class);
}
}
