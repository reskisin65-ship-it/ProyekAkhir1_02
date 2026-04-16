<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Jika user tidak punya role, redirect ke home
        if (!$user->role) {
            return redirect('/')->with('error', 'Role tidak ditemukan.');
        }
        
        // Cek apakah role user diizinkan untuk akses halaman ini
        if (in_array($user->role->nama_role, $roles)) {
            return $next($request);
        }
        
        // Jika role tidak cocok, redirect ke halaman yang sesuai (BUKAN ROUTE YANG SAMA)
        if ($user->role->nama_role === 'admin') {
            return redirect('/admin/dashboard');
        }
        
        if ($user->role->nama_role === 'umkm') {
            return redirect('/');
        }
        
        return redirect('/');
    }
}