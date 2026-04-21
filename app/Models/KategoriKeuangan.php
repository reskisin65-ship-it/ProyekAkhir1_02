<?php
// app/Models/KategoriKeuangan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriKeuangan extends Model
{
    use HasFactory;
    
    protected $table = 'kategori_keuangan';
    protected $primaryKey = 'id_kategori';
    
    protected $fillable = [
        'nama_kategori', 'jenis', 'icon', 'warna', 'urutan', 'is_active'
    ];
    
    public function transaksis()
    {
        return $this->hasMany(TransaksiKeuangan::class, 'id_kategori', 'id_kategori');
    }
    
    public function anggarans()
    {
        return $this->hasMany(AnggaranTahunan::class, 'id_kategori', 'id_kategori');
    }
    
    public function getTotalTransaksiAttribute()
    {
        return $this->transaksis()->where('status', 'disetujui')->sum('jumlah');
    }
}