<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'role_id', 'name', 'email', 'password', 'nomor_telepon', 'foto_profil',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // RELASI
    public function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }

    public function penduduk(): HasOne {
        return $this->hasOne(DataPenduduk::class, 'user_id');
    }

    public function umkm(): HasOne {
        return $this->hasOne(Umkm::class, 'user_id');
    }

    public function pengajuanSurats(): HasMany {
        return $this->hasMany(PengajuanSurat::class);
    }

    public function aspirasis(): HasMany {
        return $this->hasMany(Aspirasi::class);
    }

    public function testimonis(): HasMany {
        return $this->hasMany(Testimoni::class);
    }

    public function notifikasis(): HasMany {
        return $this->hasMany(Notifikasi::class);
    }
}