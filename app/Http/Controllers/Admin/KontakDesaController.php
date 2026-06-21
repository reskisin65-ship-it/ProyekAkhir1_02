<?php
// app/Http/Controllers/Admin/KontakDesaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KontakDesaController extends Controller
{
    public function index()
    {
        $kontak = KontakDesa::orderBy('urutan')->orderBy('id')->paginate(10);
        return view('admin.kontak-desa.index', compact('kontak'));
    }

    public function create()
    {
        return view('admin.kontak-desa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'bidang' => 'nullable|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kontak-desa', 'public');
        }

        KontakDesa::create($data);

        return redirect()->route('admin.kontak-desa.index')
            ->with('success', 'Kontak berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kontak = KontakDesa::findOrFail($id);

        return view('admin.kontak-desa.edit', compact('kontak'));
    }

    public function update(Request $request, $id)
    {
        $kontak = KontakDesa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'bidang' => 'nullable|string|max:255',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($kontak->foto) {
                Storage::disk('public')->delete($kontak->foto);
            }
            $data['foto'] = $request->file('foto')->store('kontak-desa', 'public');
        }

        $kontak->update($data);

        return redirect()->route('admin.kontak-desa.index')
            ->with('success', 'Kontak berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kontak = KontakDesa::findOrFail($id);
        if ($kontak->foto) {
            Storage::disk('public')->delete($kontak->foto);
        }
        $kontak->delete();

        return redirect()->route('admin.kontak-desa.index')
            ->with('success', 'Kontak berhasil dihapus!');
    }

    public function toggleStatus($id)
    {
        $kontak = KontakDesa::findOrFail($id);
        $kontak->update(['is_active' => !$kontak->is_active]);

        return redirect()->back()->with('success', 'Status kontak berhasil diubah!');
    }
}