<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Hanya seed roles, tidak ada data dummy lainnya
        $roles = [
            ['nama_role' => 'admin'],
            ['nama_role' => 'masyarakat'],
            ['nama_role' => 'umkm'],
        ];
        
        foreach ($roles as $role) {
            Role::create($role);
        }
        
        $this->command->info('✅ Roles seeded successfully!');
        $this->command->info('📋 Roles: admin, masyarakat, umkm');
        $this->command->info('');
        $this->command->info('⚠️  PERINGATAN: Tidak ada data dummy!');
        $this->command->info('📝 Semua data akan diisi melalui CRUD Admin nanti.');
    }
}