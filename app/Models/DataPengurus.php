<?php
// app/Models/DataPengurus.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class DataPengurus extends Model
{
    protected $table = 'data_pengurus';
    protected $primaryKey = 'id_pengurus';
    
    protected $fillable = [
        'user_id',
        'nama_pengurus',
        'nip',
        'jabatan',
        'kategori_jabatan',
        'level',
        'urutan_dalam_kategori',
        'tugas',      // Gunakan tugas, bukan deskripsi
        'foto'
    ];
    
    // Hierarki Jabatan
    public static function getHierarki()
    {
        $defaultHierarki = [
            'kepala_desa' => [
                'nama' => 'Kepala Desa',
                'level' => 1,
                'icon' => 'fa-crown',
                'color' => 'amber',
                'is_default' => true
            ],
            'sekretaris_desa' => [
                'nama' => 'Sekretaris Desa',
                'level' => 2,
                'icon' => 'fa-file-alt',
                'color' => 'blue',
                'is_default' => true
            ],
            'kepala_urusan' => [
                'nama' => 'Kepala Urusan (Kaur)',
                'level' => 3,
                'icon' => 'fa-folder-open',
                'color' => 'purple',
                'is_default' => true
            ],
            'kepala_seksi' => [
                'nama' => 'Kepala Seksi (Kasi)',
                'level' => 3,
                'icon' => 'fa-chart-line',
                'color' => 'green',
                'is_default' => true
            ],
            'kepala_dusun' => [
                'nama' => 'Kepala Dusun',
                'level' => 4,
                'icon' => 'fa-house',
                'color' => 'orange',
                'is_default' => true
            ],
            'lainnya' => [
                'nama' => 'Lainnya',
                'level' => 99,
                'icon' => 'fa-user',
                'color' => 'gray',
                'is_default' => true
            ]
        ];
        
        // Ambil custom kategori dari cache
        $customKategori = Cache::get('pengurus_custom_kategori', []);
        
        // Merge dengan default
        return array_merge($defaultHierarki, $customKategori);
    }
    
    /**
     * Tambah custom kategori
     */
    public static function addCustomKategori($key, $nama, $icon = 'fa-tag', $color = 'gray')
    {
        $customKategori = Cache::get('pengurus_custom_kategori', []);
        
        $customKategori[$key] = [
            'nama' => $nama,
            'level' => 50,  // Level default untuk custom kategori
            'icon' => $icon,
            'color' => $color,
            'is_default' => false
        ];
        
        Cache::forever('pengurus_custom_kategori', $customKategori);
    }
    
    /**
     * Hapus custom kategori
     */
    public static function removeCustomKategori($key)
    {
        $customKategori = Cache::get('pengurus_custom_kategori', []);
        
        unset($customKategori[$key]);
        
        Cache::forever('pengurus_custom_kategori', $customKategori);
    }
    
    // Scope untuk urutan hierarki
    public function scopeUrutHierarki($query)
    {
        return $query->orderBy('level', 'asc')
                     ->orderBy('urutan_dalam_kategori', 'asc');
    }
    
    // Accessor
    public function getNamaKategoriAttribute()
    {
        $hierarki = self::getHierarki();
        return $hierarki[$this->kategori_jabatan]['nama'] ?? ucfirst($this->kategori_jabatan);
    }
    
    public function getIconKategoriAttribute()
    {
        $hierarki = self::getHierarki();
        return $hierarki[$this->kategori_jabatan]['icon'] ?? 'fa-user';
    }
    
    public function getWarnaKategoriAttribute()
    {
        $hierarki = self::getHierarki();
        return $hierarki[$this->kategori_jabatan]['color'] ?? 'gray';
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}