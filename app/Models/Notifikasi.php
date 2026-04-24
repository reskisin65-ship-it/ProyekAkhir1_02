<?php
// app/Models/Notifikasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    
    protected $fillable = [
        'user_id', 'jenis', 'judul', 'pesan', 'link', 'ref_id', 'dibaca'
    ];
    
    protected $casts = [
        'dibaca' => 'boolean',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}