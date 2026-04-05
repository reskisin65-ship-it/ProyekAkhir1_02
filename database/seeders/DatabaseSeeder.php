<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\About;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat Role Master sesuai PDM
        // ID 1 = admin, ID 2 = masyarakat, ID 3 = umkm
        $adminRole = Role::create([
            'nama_role' => 'admin'
        ]);

        $masyarakatRole = Role::create([
            'nama_role' => 'masyarakat'
        ]);

        $umkmRole = Role::create([
            'nama_role' => 'umkm'
        ]);

        // 2. Membuat Akun Admin Default untuk Login Pertama Kali
        User::create([
            'role_id' => $adminRole->id,
            'name' => 'Admin Utama Silintong',
            'email' => 'admin@desa.com',
            'password' => Hash::make('password123'), // Password default
            'nomor_telepon' => '081234567890',
            'foto_profil' => null,
        ]);

        // 3. Membuat Data Profil Desa Default (About)
        // Agar tampilan Hero & Statistik di Welcome Page langsung terisi
        About::create([
            'sejarah' => 'Desa Lumban Silintong merupakan desa yang terletak di pesisir Danau Toba, Kecamatan Balige, Kabupaten Toba. Desa ini dikenal dengan keindahan alamnya dan potensi pariwisata serta UMKM yang berkembang pesat.',
            'visi' => 'Mewujudkan Desa Lumban Silintong sebagai pusat digitalisasi kearifan lokal dan pelayanan publik yang unggul di tahun 2030.',
            'misi' => '1. Meningkatkan kualitas pelayanan administrasi digital. 2. Mendorong pertumbuhan ekonomi kreatif UMKM. 3. Melestarikan lingkungan alam Danau Toba.',
            'luas_wilayah' => '120 Hektar',
            'jumlah_penduduk' => 2847,
        ]);

        // Output informasi di terminal
        $this->command->info('Seeding Berhasil!');
        $this->command->info('Akun Admin: admin@desa.com | password: password123');
    }
}