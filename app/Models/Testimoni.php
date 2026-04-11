<?php
// app/Models/Testimoni.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'testimoni';
    protected $primaryKey = 'id_testimoni';
    
    protected $fillable = [
        'user_id', 'isi_testimoni', 'rating'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}