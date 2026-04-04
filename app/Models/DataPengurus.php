<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPengurus extends Model
{
    protected $fillable = [
        'nama_pengurus', 
        'jabatan', 
        'foto', 
        'deskripsi'
    ];
}