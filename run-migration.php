<?php
/**
 * Script untuk menjalankan migration fix berita gambar
 * Akses via: http://localhost:8000/run-migration.php
 */

// Load Laravel
require_once __DIR__ . '/bootstrap/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

try {
    echo "<h2>Running Migration...</h2>";
    echo "<p>Adding 'gambar' column to berita table...</p>";
    
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    
    // Run migrate
    $output = new Symfony\Component\Console\Output\BufferedOutput();
    $status = $kernel->call('migrate', [], $output);
    
    echo "<pre>" . $output->fetch() . "</pre>";
    
    if ($status === 0) {
        echo "<h3 style='color: green;'>✓ Migration berhasil dijalankan!</h3>";
        echo "<p>Field 'gambar' sudah ditambahkan ke tabel berita.</p>";
        echo "<p>Data dari kolom 'foto' telah disalin ke kolom 'gambar'.</p>";
        echo "<a href='/berita'>Lihat Halaman Berita</a>";
    } else {
        echo "<h3 style='color: red;'>✗ Migration gagal!</h3>";
        echo "<p>Status: $status</p>";
    }
} catch (Exception $e) {
    echo "<h3 style='color: red;'>Error: " . $e->getMessage() . "</h3>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>
