<?php
// app/Models/DataPengurus.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPengurus extends Model
{
    use HasFactory;
    
    protected $table = 'data_pengurus';
    protected $primaryKey = 'id_pengurus';
    
    protected $fillable = [
        'nama_pengurus',  // HANYA 'nama_pengurus'
        'jabatan',
        'foto',
        'nip',
        'tugas',
        'urutan'
    ];
    
    // Accessor untuk kompatibilitas dengan view yang menggunakan 'nama'
    public function getNamaAttribute()
    {
        return $this->nama_pengurus;
    }
}