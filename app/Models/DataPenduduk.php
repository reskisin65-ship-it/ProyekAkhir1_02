<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataPenduduk extends Model {
    // Karena Primary Key bukan 'id' dan bukan auto-increment (tapi NIK string)
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nik',
        'user_id',
        'nama_lengkap',
        'jenis_kelamin',
        'tgl_lahir',
        'alamat',
    ];

    // Relasi balik ke User
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}