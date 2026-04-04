<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
protected $fillable = ['user_id', 'nama_usaha', 'kategori', 'no_telepon', 'alamat_usaha', 'bukti_usaha'];

public function produk() {
    return $this->hasMany(ProdukUmkm::class);
}
public function user() {
    return $this->belongsTo(User::class);
}
}
