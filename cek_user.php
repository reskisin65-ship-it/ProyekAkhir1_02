<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== DATA USER ===\n\n";

$users = DB::table('users')
    ->join('roles', 'users.id_role', '=', 'roles.id_role')
    ->select('users.email', 'roles.nama_role as role')
    ->get();

if ($users->count() > 0) {
    foreach ($users as $user) {
        echo "Email: {$user->email} | Role: {$user->role}\n";
    }
} else {
    echo "Tidak ada user\n";
}
?>
