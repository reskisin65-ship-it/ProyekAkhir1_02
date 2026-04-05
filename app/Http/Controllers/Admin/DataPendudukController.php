<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPenduduk;
use App\Models\User;
use Illuminate\Http\Request;

class DataPendudukController extends Controller
{
    // Menampilkan Daftar Penduduk
    public function index()
    {
        $penduduks = DataPenduduk::with('user')->latest()->get();
        return view('dashboard.admin.penduduk.index', compact('penduduks'));
    }

    // Menampilkan Form Tambah
    public function create()
    {
        // Ambil user yang rolenya 'masyarakat' dan belum punya data di tabel penduduk
        $users = User::where('role_id', 2)->whereDoesntHave('penduduk')->get();
        return view('dashboard.admin.penduduk.create', compact('users'));
    }

    // Simpan Data
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:data_penduduks,nik|max:20',
            'user_id' => 'required|exists:users,id',
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        DataPenduduk::create($request->all());

        return redirect()->route('admin.penduduk.index')->with('success', 'Data warga berhasil ditambahkan!');
    }

    // Form Edit
    public function edit($nik)
    {
        $penduduk = DataPenduduk::findOrFail($nik);
        return view('dashboard.admin.penduduk.edit', compact('penduduk'));
    }

    // Update Data
    public function update(Request $request, $nik)
    {
        $penduduk = DataPenduduk::findOrFail($nik);
        
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
        ]);

        $penduduk->update($request->all());

        return redirect()->route('admin.penduduk.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    // Hapus Data
    public function destroy($nik)
    {
        $penduduk = DataPenduduk::findOrFail($nik);
        $penduduk->delete();

        return redirect()->route('admin.penduduk.index')->with('success', 'Data warga telah dihapus.');
    }
}