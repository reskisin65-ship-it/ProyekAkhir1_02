<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== CEK DATA BERITA ===\n\n";

$beritas = DB::table('berita')->select('id_berita', 'judul', 'gambar', 'foto', 'status')->limit(5)->get();

if ($beritas->count() > 0) {
    foreach ($beritas as $berita) {
        echo "ID: {$berita->id_berita}\n";
        echo "Judul: {$berita->judul}\n";
        echo "Gambar: " . ($berita->gambar ?: 'NULL') . "\n";
        echo "Foto: " . ($berita->foto ?: 'NULL') . "\n";
        echo "Status: {$berita->status}\n";
        echo "Path gambar: " . ($berita->gambar ? "storage/{$berita->gambar}" : 'NULL') . "\n";
        echo "URL lengkap: " . ($berita->gambar ? asset("storage/{$berita->gambar}") : 'NULL') . "\n";
        echo str_repeat("-", 50) . "\n";
    }
} else {
    echo "❌ Tidak ada data berita\n";
}

// Cek apakah folder storage ada
$storagePath = __DIR__ . '/storage/app/public';
if (is_dir($storagePath)) {
    echo "✅ Folder storage/app/public ada\n";
    $files = scandir($storagePath);
    $imageFiles = array_filter($files, function($file) {
        return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    });
    echo "Gambar di storage: " . count($imageFiles) . " file\n";
    if (count($imageFiles) > 0) {
        echo "Files: " . implode(', ', array_slice($imageFiles, 0, 5)) . "\n";
    }
} else {
    echo "❌ Folder storage/app/public tidak ada\n";
}
?>
