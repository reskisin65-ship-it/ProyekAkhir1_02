<?php
// app/Models/Berita.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    
    protected $fillable = [
        'user_id', 'judul', 'slug', 'kategori', 'ringkasan', 
        'isi_berita', 'gambar', 'status', 'dibaca', 'tanggal_publikasi'
    ];
    
    protected $casts = [
        'tanggal_publikasi' => 'date'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    
    // Auto-generate slug ketika membuat berita baru
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($berita) {
            $berita->slug = Str::slug($berita->judul) . '-' . time();
        });
        
        static::updating(function ($berita) {
            if ($berita->isDirty('judul')) {
                $berita->slug = Str::slug($berita->judul) . '-' . time();
            }
        });
    }
}