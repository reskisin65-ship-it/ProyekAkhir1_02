<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    protected $fillable = [
        'user_id', 
        'judul_galeri', 
        'gambar_galeri', 
        'kategori'
    ];

    public function admin(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}