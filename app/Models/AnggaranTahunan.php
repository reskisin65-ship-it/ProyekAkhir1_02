<?php
// app/Models/AnggaranTahunan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnggaranTahunan extends Model
{
    use HasFactory;
    
    protected $table = 'anggaran_tahunan';
    protected $primaryKey = 'id_anggaran';
    
    protected $fillable = [
        'tahun', 'id_kategori', 'target_anggaran', 'keterangan'
    ];
    
    protected $casts = [
        'target_anggaran' => 'decimal:2'
    ];
    
    public function kategori()
    {
        return $this->belongsTo(KategoriKeuangan::class, 'id_kategori', 'id_kategori');
    }
    
    public function getRealisasiAttribute()
    {
        return $this->kategori->transaksis()
            ->whereYear('tanggal', $this->tahun)
            ->where('status', 'disetujui')
            ->sum('jumlah');
    }
    
    public function getPersentaseAttribute()
    {
        if ($this->target_anggaran == 0) return 0;
        return round(($this->realisasi / $this->target_anggaran) * 100, 2);
    }
}