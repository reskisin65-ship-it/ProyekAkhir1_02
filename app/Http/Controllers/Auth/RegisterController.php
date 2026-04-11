<?php
// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',  // ← ubah dari 'nama' ke 'name'
            'email' => 'required|email|unique:users,email',
            'nomor_telepon' => 'nullable|max:15',
            'password' => 'required|min:6|confirmed',
        ]);

        // Dapatkan role masyarakat
        $roleMasyarakat = Role::where('nama_role', 'masyarakat')->first();

        $user = User::create([
            'name' => $request->name,  // ← ubah dari 'nama' ke 'name'
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nomor_telepon' => $request->nomor_telepon,
            'id_role' => $roleMasyarakat->id_role ?? 2,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
    }
}