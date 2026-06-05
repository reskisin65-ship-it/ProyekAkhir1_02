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
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'nomor_telepon' => 'nullable|string|max:15|unique:users,nomor_telepon',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama harus terdiri dari minimal 3 karakter.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'nomor_telepon.max' => 'Nomor telepon maksimal 15 karakter.',
            'nomor_telepon.unique' => 'Nomor WhatsApp ini sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus terdiri dari minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
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