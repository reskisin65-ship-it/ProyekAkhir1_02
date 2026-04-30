<?php
// app/Http/Controllers/Admin/DataPengurusController.php

namespace App\Http\Controllers\Admin;

use App\Models\DataPengurus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class DataPengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DataPengurus::query();
        
        // Filter berdasarkan kategori
        if ($request->filled('kategori') && $request->kategori != 'semua') {
            $query->where('kategori_jabatan', $request->kategori);
        }
        
        $pengurus = $query->urutHierarki()->paginate(12);
        
        // Statistik per kategori
        $hierarki = DataPengurus::getHierarki();
        $statistik = ['total' => DataPengurus::count()];
        
        foreach (array_keys($hierarki) as $key) {
            $statistik[$key] = DataPengurus::where('kategori_jabatan', $key)->count();
        }
        
        return view('admin.pengurus', compact('pengurus', 'statistik', 'hierarki'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hierarki = DataPengurus::getHierarki();
        return view('admin.pengurus-create', compact('hierarki'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengurus' => 'required|max:100',
            'jabatan' => 'required|max:50',
            'kategori_jabatan' => 'required',
            'nip' => 'nullable|max:50',
            'tugas' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $data = $request->except('foto');
        
        // Set level berdasarkan kategori
        $hierarki = DataPengurus::getHierarki();
        $data['level'] = $hierarki[$request->kategori_jabatan]['level'] ?? 99;
        
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('pengurus', 'public');
            $data['foto'] = $path;
        }
        
        // Hitung urutan_dalam_kategori otomatis
        $maxUrutan = DataPengurus::where('kategori_jabatan', $request->kategori_jabatan)
                                 ->max('urutan_dalam_kategori');
        $data['urutan_dalam_kategori'] = $maxUrutan + 1;
        
        DataPengurus::create($data);
        
        return redirect()->route('admin.pengurus.index')
                         ->with('success', 'Pengurus berhasil ditambahkan');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pengurus = DataPengurus::findOrFail($id);
        $hierarki = DataPengurus::getHierarki();
        return view('admin.pengurus-edit', compact('pengurus', 'hierarki'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengurus = DataPengurus::findOrFail($id);
        
        $request->validate([
            'nama_pengurus' => 'required|max:100',
            'jabatan' => 'required|max:50',
            'kategori_jabatan' => 'required',
            'nip' => 'nullable|max:50',
            'tugas' => 'nullable',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $data = $request->except('foto');
        
        // Update level jika kategori berubah
        $hierarki = DataPengurus::getHierarki();
        $data['level'] = $hierarki[$request->kategori_jabatan]['level'] ?? 99;
        
        if ($request->hasFile('foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $path = $request->file('foto')->store('pengurus', 'public');
            $data['foto'] = $path;
        }
        
        // Jika kategori berubah, reset urutan
        if ($pengurus->kategori_jabatan != $request->kategori_jabatan) {
            $maxUrutan = DataPengurus::where('kategori_jabatan', $request->kategori_jabatan)
                                     ->max('urutan_dalam_kategori');
            $data['urutan_dalam_kategori'] = $maxUrutan + 1;
        }
        
        $pengurus->update($data);
        
        return redirect()->route('admin.pengurus.index')
                         ->with('success', 'Pengurus berhasil diperbarui');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pengurus = DataPengurus::findOrFail($id);
        if ($pengurus->foto) {
            Storage::disk('public')->delete($pengurus->foto);
        }
        $pengurus->delete();
        
        return redirect()->route('admin.pengurus.index')
                         ->with('success', 'Pengurus berhasil dihapus');
    }
    
    /**
     * Update urutan dalam satu kategori (drag & drop)
     */
    public function updateUrutan(Request $request)
    {
        $request->validate([
            'urutan' => 'required|array',
            'urutan.*' => 'exists:data_pengurus,id_pengurus'
        ]);
        
        foreach ($request->urutan as $index => $id) {
            DataPengurus::where('id_pengurus', $id)
                        ->update(['urutan_dalam_kategori' => $index + 1]);
        }
        
        return response()->json(['success' => true, 'message' => 'Urutan berhasil disimpan']);
    }
    
    /**
     * Display kategori management page
     */
    public function showKategori()
    {
        $hierarki = DataPengurus::getHierarki();
        return view('admin.pengurus-kategori', compact('hierarki'));
    }
    
    /**
     * Store a new custom kategori
     */
    public function storeKategori(Request $request)
    {
        $request->validate([
            'key' => 'required|alpha_dash',
            'nama' => 'required|max:50',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:20'
        ]);
        
        DataPengurus::addCustomKategori(
            $request->key,
            $request->nama,
            $request->icon ?? 'fa-tag',
            $request->color ?? 'gray'
        );
        
        return redirect()->route('admin.pengurus.kategori')
                         ->with('success', 'Kategori "' . $request->nama . '" berhasil ditambahkan');
    }
    
    /**
     * Remove a custom kategori
     */
    public function destroyKategori($key)
    {
        // Cek apakah ada pengurus dengan kategori ini
        $count = DataPengurus::where('kategori_jabatan', $key)->count();
        if ($count > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih ada ' . $count . ' pengurus dengan kategori ini');
        }
        
        // Cek apakah kategori adalah default (tidak boleh dihapus)
        $hierarki = DataPengurus::getHierarki();
        if (isset($hierarki[$key]) && ($hierarki[$key]['is_default'] ?? false)) {
            return back()->with('error', 'Kategori default tidak bisa dihapus');
        }
        
        DataPengurus::removeCustomKategori($key);
        
        return redirect()->route('admin.pengurus.kategori')
                         ->with('success', 'Kategori berhasil dihapus');
    }
    
    /**
     * Sync all pengurus levels (untuk maintenance)
     */
    public function syncLevels()
    {
        $hierarki = DataPengurus::getHierarki();
        $pengurus = DataPengurus::all();
        $updated = 0;
        
        foreach ($pengurus as $p) {
            $newLevel = $hierarki[$p->kategori_jabatan]['level'] ?? 99;
            if ($p->level != $newLevel) {
                $p->level = $newLevel;
                $p->save();
                $updated++;
            }
        }
        
        return redirect()->route('admin.pengurus.index')
                         ->with('success', "Berhasil menyinkronkan level {$updated} pengurus");
    }
}