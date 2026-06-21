<?php
// app/Http/Controllers/Admin/KontakDesaController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KontakDesa;
use App\Models\DataPengurus;
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
        $hierarki = DataPengurus::getHierarki();
        $jabatanOptionsByCategory = DataPengurus::select('kategori_jabatan', 'jabatan')
            ->whereNotNull('jabatan')
            ->orderBy('kategori_jabatan')
            ->orderBy('jabatan')
            ->get()
            ->groupBy('kategori_jabatan')
            ->map(function ($items) {
                return $items->pluck('jabatan')->unique()->values();
            });

        foreach ($jabatanOptionsByCategory->keys() as $kategori) {
            if (!isset($hierarki[$kategori])) {
                $hierarki[$kategori] = [
                    'nama' => ucfirst(str_replace('_', ' ', $kategori)),
                    'level' => 99,
                    'icon' => 'fa-user',
                    'color' => 'gray',
                    'is_default' => false,
                ];
            }
        }

        $jabatanGroups = collect($hierarki)
            ->sortBy('level')
            ->mapWithKeys(function ($meta, $kategori) use ($jabatanOptionsByCategory) {
                return [$kategori => [
                    'label' => $meta['nama'] ?? ucfirst(str_replace('_', ' ', $kategori)),
                    'options' => $jabatanOptionsByCategory->get($kategori, collect()),
                ]];
            });

        return view('admin.kontak-desa.create', compact('jabatanGroups'));
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
        $data['kategori_jabatan'] = DataPengurus::where('jabatan', $request->input('jabatan'))
            ->value('kategori_jabatan');

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

        $hierarki = DataPengurus::getHierarki();
        $jabatanOptionsByCategory = DataPengurus::select('kategori_jabatan', 'jabatan')
            ->whereNotNull('jabatan')
            ->orderBy('kategori_jabatan')
            ->orderBy('jabatan')
            ->get()
            ->groupBy('kategori_jabatan')
            ->map(function ($items) {
                return $items->pluck('jabatan')->unique()->values();
            });

        foreach ($jabatanOptionsByCategory->keys() as $kategori) {
            if (!isset($hierarki[$kategori])) {
                $hierarki[$kategori] = [
                    'nama' => ucfirst(str_replace('_', ' ', $kategori)),
                    'level' => 99,
                    'icon' => 'fa-user',
                    'color' => 'gray',
                    'is_default' => false,
                ];
            }
        }

        $jabatanGroups = collect($hierarki)
            ->sortBy('level')
            ->mapWithKeys(function ($meta, $kategori) use ($jabatanOptionsByCategory) {
                return [$kategori => [
                    'label' => $meta['nama'] ?? ucfirst(str_replace('_', ' ', $kategori)),
                    'options' => $jabatanOptionsByCategory->get($kategori, collect()),
                ]];
            });

        return view('admin.kontak-desa.edit', compact('kontak', 'jabatanGroups'));
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
        $data['kategori_jabatan'] = DataPengurus::where('jabatan', $request->input('jabatan'))
            ->value('kategori_jabatan');

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