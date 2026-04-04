<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    protected $fillable = [
        'user_id', 
        'judul', 
        'isi_berita', 
        'foto', 
        'kategori', 
        'status'
    ];

    // Penulis berita (Admin)
    public function admin(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}