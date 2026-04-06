<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataPenduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduks = DataPenduduk::latest()->get();
        return view('dashboard.admin.penduduk.index', compact('penduduks'));
    }

    public function create()
    {
        return view('dashboard.admin.penduduk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:data_penduduks,nik|max:20',
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
        ]);

        DataPenduduk::create([
            'nik' => $request->nik,
            'user_id' => null, // Belum punya akun login
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.penduduk.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function destroy(DataPenduduk $penduduk)
    {
        $penduduk->delete();
        return redirect()->route('admin.penduduk.index')->with('success', 'Data warga berhasil dihapus.');
    }
}