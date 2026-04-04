<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspirasi extends Model
{
    protected $fillable = [
        'user_id', 
        'kategori', 
        'isi_aspirasi', 
        'status', 
        'lampiran'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}