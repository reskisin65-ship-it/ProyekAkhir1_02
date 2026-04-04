<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DataPenduduk;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth/register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Inputan
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nik' => ['required', 'string', 'max:20', 'unique:data_penduduks,nik'],
            'nomor_telepon' => ['required', 'string', 'max:20'],
            'jenis_kelamin' => ['required', 'string'],
            'tgl_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string'],
        ]);

        // 2. Simpan ke Tabel Users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, // ID 2 adalah Masyarakat (sesuai Seeder kita)
            'nomor_telepon' => $request->nomor_telepon,
        ]);

        // 3. Simpan ke Tabel Data Penduduk (Relasi 1:1)
        DataPenduduk::create([
            'nik' => $request->nik,
            'user_id' => $user->id,
            'nama_lengkap' => $request->name, // Mengambil nama dari input registrasi
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}