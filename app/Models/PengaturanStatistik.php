<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanStatistik extends Model
{
    protected $table = 'pengaturan_statistik';
    public $timestamps = false;

    protected $fillable = [
        'key',
        'nilai_awal',
        'mode',
    ];
}
