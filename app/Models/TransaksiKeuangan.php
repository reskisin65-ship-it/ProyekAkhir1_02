<?php
// app/Models/TransaksiKeuangan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiKeuangan extends Model
{
    use HasFactory;
    
    protected $table = 'transaksi_keuangan';
    protected $primaryKey = 'id_transaksi';
    
    protected $fillable = [
        'tanggal', 'jenis', 'id_kategori', 'deskripsi', 
        'jumlah', 'bukti_foto', 'status', 'created_by', 
        'approved_by', 'catatan_admin'
    ];
    
    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2'
    ];
    
    public function kategori()
    {
        return $this->belongsTo(KategoriKeuangan::class, 'id_kategori', 'id_kategori');
    }
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }
    
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by', 'user_id');
    }
    
    public function getJumlahFormattedAttribute()
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }
}