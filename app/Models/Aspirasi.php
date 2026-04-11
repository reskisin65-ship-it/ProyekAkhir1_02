<?php
// app/Models/Aspirasi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';
    
    protected $fillable = [
        'user_id', 'kategori', 'isi_aspirasi', 'status', 'lampiran'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}