<?php
// database/seeders/KategoriKeuanganSeeder.php

namespace Database\Seeders;

use App\Models\KategoriKeuangan;
use Illuminate\Database\Seeder;

class KategoriKeuanganSeeder extends Seeder
{
    public function run()
    {
        $kategoris = [
            // Pemasukan
            ['nama_kategori' => 'ADD (Alokasi Dana Desa)', 'jenis' => 'pemasukan', 'icon' => 'fa-solid fa-building', 'warna' => '#10b981', 'urutan' => 1],
            ['nama_kategori' => 'BUMDes', 'jenis' => 'pemasukan', 'icon' => 'fa-solid fa-store', 'warna' => '#3b82f6', 'urutan' => 2],
            ['nama_kategori' => 'Swadaya Masyarakat', 'jenis' => 'pemasukan', 'icon' => 'fa-solid fa-hand-holding-heart', 'warna' => '#8b5cf6', 'urutan' => 3],
            ['nama_kategori' => 'Retribusi', 'jenis' => 'pemasukan', 'icon' => 'fa-solid fa-ticket', 'warna' => '#f59e0b', 'urutan' => 4],
            
            // Pengeluaran
            ['nama_kategori' => 'Pembangunan Infrastruktur', 'jenis' => 'pengeluaran', 'icon' => 'fa-solid fa-hard-hat', 'warna' => '#ef4444', 'urutan' => 5],
            ['nama_kategori' => 'Operasional Kantor', 'jenis' => 'pengeluaran', 'icon' => 'fa-solid fa-building', 'warna' => '#6b7280', 'urutan' => 6],
            ['nama_kategori' => 'Kegiatan Sosial', 'jenis' => 'pengeluaran', 'icon' => 'fa-solid fa-hand-sparkles', 'warna' => '#ec489a', 'urutan' => 7],
            ['nama_kategori' => 'Pendidikan & Pelatihan', 'jenis' => 'pengeluaran', 'icon' => 'fa-solid fa-graduation-cap', 'warna' => '#06b6d4', 'urutan' => 8],
            ['nama_kategori' => 'Kesehatan', 'jenis' => 'pengeluaran', 'icon' => 'fa-solid fa-hospital-user', 'warna' => '#14b8a6', 'urutan' => 9],
            ['nama_kategori' => 'Bantuan Sosial', 'jenis' => 'pengeluaran', 'icon' => 'fa-solid fa-hand-holding-heart', 'warna' => '#f97316', 'urutan' => 10],
        ];
        
        foreach ($kategoris as $k) {
            KategoriKeuangan::create($k);
        }
    }
}