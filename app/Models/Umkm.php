<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Umkm extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'umkm';

    // Primary key yang Anda gunakan
    protected $primaryKey = 'id_umkm';
    
    protected $fillable = [
        'user_id', 
        'nama_usaha', 
        'kategori', 
        'pemilik', 
        'no_telepon',
        'alamat_usaha', 
        'deskripsi', 
        'logo', 
        'bukti_usaha', 
        'status'
    ];
    
    /**
     * Relasi ke User
     */
    public function user()
    {
        // Pastikan foreign key dan owner key sesuai dengan tabel users Anda
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    
    /**
     * Relasi ke Produk
     * Karena primary key kita bukan 'id', maka harus didefinisikan manual
     */
    public function products() 
    {
        // Parameter 2: Foreign Key di tabel products (umkm_id)
        // Parameter 3: Local Key di tabel umkm (id_umkm)
        return $this->hasMany(ProdukUmkm::class, 'umkm_id', 'id_umkm');

    }
}