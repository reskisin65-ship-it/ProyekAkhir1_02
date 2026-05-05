<?php
// app/Models/KontakDesa.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakDesa extends Model
{
    use HasFactory;

    protected $table = 'kontak_desas';
    
    protected $fillable = [
        'nama', 'jabatan', 'bidang', 'no_hp', 'email', 
        'foto', 'urutan', 'is_active'
    ];
}