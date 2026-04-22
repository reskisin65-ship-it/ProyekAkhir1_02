<?php
// app/Http/Controllers/Admin/ProfilDesaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa;
use App\Models\DataPengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilDesaController extends Controller
{
    public function index()
    {
        $profil = ProfilDesa::first();
        $aparaturs = DataPengurus::orderBy('urutan', 'asc')->get();
        
        return view('admin.profil-desa.index', compact('profil', 'aparaturs'));
    }
    
    public function edit()
    {
        $profil = ProfilDesa::first();
        return view('admin.profil-desa.edit', compact('profil'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'luas_wilayah' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',
            'tahun_berdiri' => 'nullable|string',
            'jumlah_dusun' => 'nullable|integer',
            'alamat_kantor' => 'nullable|string',
            'email_desa' => 'nullable|email',
            'telepon_desa' => 'nullable|string',
            'maps_embed' => 'nullable|string',
            'foto_kantor' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_kegiatan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        $profil = ProfilDesa::first();
        
        $data = $request->except(['foto_kantor', 'foto_kegiatan', '_token', '_method']);
        
        if ($request->hasFile('foto_kantor')) {
            if ($profil && $profil->foto_kantor && Storage::disk('public')->exists($profil->foto_kantor)) {
                Storage::disk('public')->delete($profil->foto_kantor);
            }
            $data['foto_kantor'] = $request->file('foto_kantor')->store('profil-desa', 'public');
        }
        
        if ($request->hasFile('foto_kegiatan')) {
            if ($profil && $profil->foto_kegiatan && Storage::disk('public')->exists($profil->foto_kegiatan)) {
                Storage::disk('public')->delete($profil->foto_kegiatan);
            }
            $data['foto_kegiatan'] = $request->file('foto_kegiatan')->store('profil-desa', 'public');
        }
        
        if ($profil) {
            $profil->update($data);
        } else {
            ProfilDesa::create($data);
        }
        
        return redirect()->route('admin.profil-desa.index')
            ->with('success', 'Profil desa berhasil diperbarui!');
    }
}