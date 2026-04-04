<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\About;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Roles Master
        $adminRole = Role::create(['nama_role' => 'admin']);
        $wargaRole = Role::create(['nama_role' => 'masyarakat']);
        $umkmRole = Role::create(['nama_role' => 'umkm']);

        // 2. Buat Akun Admin Utama
        User::create([
            'name' => 'Admin Lumban Silintong',
            'email' => 'admin@desa.com',
            'password' => 'password123', // Otomatis di-hash oleh model
            'role_id' => $adminRole->id,
            'nomor_telepon' => '081122334455',
        ]);

        // 3. Isi Data Profil Desa (Default)
        About::create([
            'sejarah' => 'Sejarah singkat Desa Lumban Silintong...',
            'visi' => 'Visi Desa Lumban Silintong...',
            'misi' => 'Misi Desa Lumban Silintong...',
            'luas_wilayah' => '100 Hektar',
            'jumlah_penduduk' => 2500,
        ]);
    }
}