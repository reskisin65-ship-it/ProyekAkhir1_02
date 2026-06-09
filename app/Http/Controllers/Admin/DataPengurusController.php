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
        
        $pengurus = $query->orderBy('urutan_dalam_kategori', 'asc')->orderBy('id_pengurus', 'asc')->paginate(12);
        
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
            'nama_pengurus'    => 'required|max:100',
            'kategori_jabatan' => 'required',
            'nip'              => 'required|digits:18|unique:data_pengurus,nip',
            'tugas'            => 'nullable',
            'foto'             => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.digits' => 'NIP harus terdiri dari 18 digit angka.',
            'nip.unique' => 'NIP sudah digunakan oleh pengurus lain.',
        ]);

        $hierarki = DataPengurus::getHierarki();

        $inputPosisi = $request->input('urutan_dalam_kategori');
        $posisi = ($inputPosisi !== null && $inputPosisi !== '' && (int)$inputPosisi >= 1)
            ? (int)$inputPosisi
            : (int) DataPengurus::max('urutan_dalam_kategori') + 1;

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('pengurus', 'public');
        }

        DataPengurus::create([
            'nama_pengurus'         => $request->nama_pengurus,
            'nip'                   => $request->nip,
            'jabatan'               => $hierarki[$request->kategori_jabatan]['nama'] ?? $request->kategori_jabatan,
            'kategori_jabatan'      => $request->kategori_jabatan,
            'level'                 => $hierarki[$request->kategori_jabatan]['level'] ?? 99,
            'urutan_dalam_kategori' => $posisi,
            'tugas'                 => $request->tugas,
            'foto'                  => $foto,
        ]);

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
            'nama_pengurus'    => 'required|max:100',
            'kategori_jabatan' => 'required',
            'nip'              => 'required|digits:18|unique:data_pengurus,nip,' . $pengurus->id_pengurus . ',id_pengurus',
            'tugas'            => 'nullable',
            'foto'             => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nip.required' => 'NIP wajib diisi.',
            'nip.digits' => 'NIP harus terdiri dari 18 digit angka.',
            'nip.unique' => 'NIP sudah digunakan oleh pengurus lain.',
        ]);

        $hierarki = DataPengurus::getHierarki();

        // Posisi: bebas diisi angka berapa saja >= 1, kosong = pertahankan lama
        $inputPosisi = $request->input('urutan_dalam_kategori');
        $posisi = ($inputPosisi !== null && $inputPosisi !== '' && (int)$inputPosisi >= 1)
            ? (int)$inputPosisi
            : $pengurus->urutan_dalam_kategori;

        $foto = $pengurus->foto;
        if ($request->hasFile('foto')) {
            if ($pengurus->foto) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            $foto = $request->file('foto')->store('pengurus', 'public');
        }

        $pengurus->update([
            'nama_pengurus'         => $request->nama_pengurus,
            'nip'                   => $request->nip,
            'jabatan'               => $hierarki[$request->kategori_jabatan]['nama'] ?? $request->kategori_jabatan,
            'kategori_jabatan'      => $request->kategori_jabatan,
            'level'                 => $hierarki[$request->kategori_jabatan]['level'] ?? 99,
            'urutan_dalam_kategori' => $posisi,
            'tugas'                 => $request->tugas,
            'foto'                  => $foto,
        ]);

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
     * Naik satu posisi (global) — tukar dengan record di atasnya
     */
    public function naikUrutan($id)
    {
        $pengurus = DataPengurus::findOrFail($id);
        $currentPos = $pengurus->urutan_dalam_kategori;

        if ($currentPos <= 1) {
            return back()->with('info', 'Sudah di posisi paling atas.');
        }

        // Cari record yang ada di posisi lebih kecil terdekat
        $above = DataPengurus::where('urutan_dalam_kategori', '<', $currentPos)
                             ->where('id_pengurus', '!=', $pengurus->id_pengurus)
                             ->orderBy('urutan_dalam_kategori', 'desc')
                             ->first();

        if ($above) {
            $newPos   = $above->urutan_dalam_kategori;
            $abovePos = $currentPos;

            // Pakai nilai sementara untuk hindari unique constraint jika ada
            $above->update(['urutan_dalam_kategori' => 99999]);
            $pengurus->update(['urutan_dalam_kategori' => $newPos]);
            $above->update(['urutan_dalam_kategori' => $abovePos]);
        } else {
            $pengurus->update(['urutan_dalam_kategori' => $currentPos - 1]);
        }

        return back()->with('success', 'Posisi naik.');
    }

    /**
     * Turun satu posisi (global) — tukar dengan record di bawahnya
     */
    public function turunUrutan($id)
    {
        $pengurus = DataPengurus::findOrFail($id);
        $currentPos = $pengurus->urutan_dalam_kategori;

        // Cari record yang ada di posisi lebih besar terdekat
        $below = DataPengurus::where('urutan_dalam_kategori', '>', $currentPos)
                             ->where('id_pengurus', '!=', $pengurus->id_pengurus)
                             ->orderBy('urutan_dalam_kategori', 'asc')
                             ->first();

        if ($below) {
            $newPos   = $below->urutan_dalam_kategori;
            $belowPos = $currentPos;

            $below->update(['urutan_dalam_kategori' => 99999]);
            $pengurus->update(['urutan_dalam_kategori' => $newPos]);
            $below->update(['urutan_dalam_kategori' => $belowPos]);
        } else {
            $pengurus->update(['urutan_dalam_kategori' => $currentPos + 1]);
        }

        return back()->with('success', 'Posisi turun.');
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