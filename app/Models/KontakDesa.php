<?php
// app/Models/KontakDesa.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakDesa extends Model
{
    use HasFactory;

    protected $table = 'kontak_desa';
    
    protected $fillable = [
        'user_id', 'nama', 'jabatan', 'kategori_jabatan', 'bidang', 'no_hp', 'email', 
        'foto', 'urutan', 'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}