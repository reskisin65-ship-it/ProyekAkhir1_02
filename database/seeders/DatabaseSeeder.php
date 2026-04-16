<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==============================================
        // 1. SEED ROLES (TANPA DESKRIPSI)
        // ==============================================
        $roles = ['admin', 'masyarakat', 'umkm'];
        
        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['nama_role' => $role],
                // HAPUS 'deskripsi' karena kolomnya tidak ada
            );
        }
        
        $this->command->info('✅ Roles seeded: admin, masyarakat, umkm');
        
        // ==============================================
        // 2. SEED ADMIN USER
        // ==============================================
        $roleAdmin = Role::where('nama_role', 'admin')->first();
        
        if ($roleAdmin) {
            User::firstOrCreate(
                ['email' => 'admin@desa.com'],
                [
                    'name' => 'Admin Desa',
                    'password' => Hash::make('password123'),
                    'id_role' => $roleAdmin->id_role,
                ]
            );
            $this->command->info('✅ Admin user: admin@desa.com / password123');
        }
        
        $this->command->info('🔑 Login: admin@desa.com / password123');
    }
}