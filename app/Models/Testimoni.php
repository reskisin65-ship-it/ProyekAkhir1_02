<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimoni extends Model
{
    protected $fillable = [
        'user_id', 
        'isi_testimoni', 
        'rating'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}