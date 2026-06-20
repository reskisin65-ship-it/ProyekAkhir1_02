<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\ProfilDesa;
use App\Models\KategoriKeuangan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =============================================
        // 1. ROLES
        // =============================================
        $roles = ['admin', 'masyarakat', 'umkm'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['nama_role' => $role]);
        }
        $this->command->info('✅ Roles seeded: admin, masyarakat, umkm');

        // =============================================
        // 2. ADMIN USER
        // =============================================
        $roleAdmin = Role::where('nama_role', 'admin')->first();
        if ($roleAdmin) {
            User::firstOrCreate(
                ['email' => 'admin@desa.com'],
                [
                    'name'     => 'Admin Desa',
                    'password' => Hash::make('password123'),
                    'id_role'  => $roleAdmin->id_role,
                ]
            );
        }
        $this->command->info('✅ Admin: admin@desa.com / password123');

        // =============================================
        // 3. PROFIL DESA (data default agar halaman tidak error)
        // =============================================
        ProfilDesa::firstOrCreate(
            ['id' => 1],
            [
                'sejarah'       => 'Desa Lumban Silintong merupakan desa yang terletak di kawasan Danau Toba, Sumatera Utara. Desa ini memiliki sejarah panjang dan kaya akan budaya Batak.',
                'visi'          => 'Terwujudnya Desa Lumban Silintong yang maju, mandiri, dan sejahtera berlandaskan nilai-nilai budaya Batak.',
                'misi'          => "1. Meningkatkan kualitas pelayanan publik\n2. Mengembangkan potensi ekonomi lokal\n3. Melestarikan budaya dan lingkungan hidup\n4. Meningkatkan partisipasi masyarakat",
                'luas_wilayah'  => '12.5 km²',
                'kecamatan'     => 'Balige',
                'kabupaten'     => 'Toba',
                'provinsi'      => 'Sumatera Utara',
                'tahun_berdiri' => '1920',
                'jumlah_dusun'  => 6,
                'alamat_kantor' => 'Jl. Lumban Silintong No. 1, Balige, Toba, Sumatera Utara',
                'email_desa'    => 'desa.lumbansilintong@gmail.com',
                'telepon_desa'  => '0812-3456-7890',
                'maps_embed'    => '',
            ]
        );
        $this->command->info('✅ Profil Desa seeded');

        // =============================================
        // 4. KATEGORI KEUANGAN
        // =============================================
        $this->call(KategoriKeuanganSeeder::class);
        $this->command->info('✅ Kategori Keuangan seeded');

        $this->command->info('');
        $this->command->info('🔑 Login: admin@desa.com / password123');
    }
}
