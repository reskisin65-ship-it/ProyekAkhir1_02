<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // Cek apakah nama role user ada dalam daftar role yang diizinkan di route
        if (in_array($user->role->nama_role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, lempar ke halaman awal dashboard mereka sendiri
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}