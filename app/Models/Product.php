<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Menentukan nama tabel (karena kita menggunakan 'products')
    protected $table = 'products';

    // Mendaftarkan kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'umkm_id',
        'nama_produk',
        'harga',
        'deskripsi',
        'foto'
    ];

    /**
     * Relasi ke model Umkm
     * Satu produk dimiliki oleh satu UMKM
     */
    public function umkm()
    {
        // Parameter kedua: nama foreign key di tabel products
        // Parameter ketiga: nama primary key di tabel umkm (id_umkm)
        return $this->belongsTo(Umkm::class, 'umkm_id', 'id_umkm');
    }
}