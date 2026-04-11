<?php
// app/Models/DataPengurus.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPengurus extends Model
{
    protected $table = 'data_pengurus';
    protected $primaryKey = 'id_pengurus';
    
    protected $fillable = [
        'user_id', 'nama_pengurus', 'jabatan', 'foto', 'deskripsi'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}