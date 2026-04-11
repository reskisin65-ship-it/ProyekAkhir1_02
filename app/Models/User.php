<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    protected $table = 'users';
    
    protected $fillable = [
        'id_role', 'name', 'email', 'password', 'nomor_telepon', 'foto_profil'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relasi ke Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }
    
    // Helper cek role
    public function isAdmin()
    {
        return $this->role && $this->role->nama_role === 'admin';
    }
    
    public function isMasyarakat()
    {
        return $this->role && $this->role->nama_role === 'masyarakat';
    }
    
    public function isUmkm()
    {
        return $this->role && $this->role->nama_role === 'umkm';
    }
    
    // Relasi ke About (Profil Desa)
    public function about()
    {
        return $this->hasOne(About::class, 'user_id', 'user_id');
    }
    
    // Relasi ke Data Pengurus
    public function dataPengurus()
    {
        return $this->hasOne(DataPengurus::class, 'user_id', 'user_id');
    }
    
    // Relasi ke Berita
    public function berita()
    {
        return $this->hasMany(Berita::class, 'user_id', 'user_id');
    }
    
    // Relasi ke UMKM
    public function umkm()
    {
        return $this->hasOne(Umkm::class, 'user_id', 'user_id');
    }
    
    // Relasi ke Pengajuan Surat
    public function pengajuanSurat()
    {
        return $this->hasMany(PengajuanSurat::class, 'user_id', 'user_id');
    }
    
    // Relasi ke Aspirasi
    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class, 'user_id', 'user_id');
    }
    
    // Relasi ke Testimoni
    public function testimoni()
    {
        return $this->hasMany(Testimoni::class, 'user_id', 'user_id');
    }
    
    // Relasi ke Notifikasi
    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'user_id', 'user_id');
    }
    
    // Notifikasi yang belum dibaca
    public function notifikasiBelumDibaca()
    {
        return $this->notifikasi()->where('dibaca', false);
    }
}