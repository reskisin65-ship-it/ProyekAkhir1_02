<?php
// app/Models/Aspirasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aspirasi extends Model
{
    use HasFactory;
    
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';
    
    protected $fillable = [
        'user_id', 
        'judul',
        'isi_aspirasi', 
        'kategori', 
        'status', 
        'respon_admin',  
        'lampiran'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    
    // Scope untuk filter status
    public function scopeStatus($query, $status)
    {
        if ($status && $status != 'all') {
            return $query->where('status', $status);
        }
        return $query;
    }
    
    // Scope untuk filter kategori
    public function scopeKategori($query, $kategori)
    {
        if ($kategori && $kategori != 'all') {
            return $query->where('kategori', $kategori);
        }
        return $query;
    }
}