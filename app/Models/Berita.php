<?php
// app/Models/Berita.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    
    protected $fillable = [
        'user_id', 'judul', 'isi_berita', 'kategori', 'foto', 'status'
    ];
    
    protected $casts = [
        'tanggal_publikasi' => 'date'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}