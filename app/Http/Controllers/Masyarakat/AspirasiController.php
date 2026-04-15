<?php
// app/Http/Controllers/Masyarakat/AspirasiController.php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AspirasiController extends Controller
{
    public function index()
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('masyarakat.aspirasi.index', compact('aspirasi'));
    }

    public function create()
    {
        return view('masyarakat.aspirasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:saran,keluhan,masukan,pertanyaan',
            'judul' => 'required|min:5|max:100',
            'isi' => 'required|min:10',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('aspirasi_lampiran', 'public');
        }

        Aspirasi::create([
            'user_id' => Auth::id(),
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'isi_aspirasi' => $request->isi,
            'lampiran' => $lampiranPath,
            'status' => 'baru',
        ]);

        return redirect()->route('masyarakat.aspirasi.index')
            ->with('success', 'Aspirasi berhasil dikirim!');
    }

    public function show($id)
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())
            ->where('id_aspirasi', $id)
            ->firstOrFail();
        
        return view('masyarakat.aspirasi.show', compact('aspirasi'));
    }

    public function edit($id)
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())
            ->where('id_aspirasi', $id)
            ->firstOrFail();
        
        if ($aspirasi->status !== 'baru') {
            return redirect()->route('masyarakat.aspirasi.index')
                ->with('error', 'Aspirasi tidak dapat diedit karena sudah diproses!');
        }
        
        return view('masyarakat.aspirasi.edit', compact('aspirasi'));
    }

    public function update(Request $request, $id)
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())
            ->where('id_aspirasi', $id)
            ->firstOrFail();
        
        if ($aspirasi->status !== 'baru') {
            return redirect()->route('masyarakat.aspirasi.index')
                ->with('error', 'Aspirasi tidak dapat diedit karena sudah diproses!');
        }
        
        $request->validate([
            'kategori' => 'required|in:saran,keluhan,masukan,pertanyaan',
            'judul' => 'required|min:5|max:100',
            'isi' => 'required|min:10',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $lampiranPath = $aspirasi->lampiran;
        if ($request->hasFile('lampiran')) {
            if ($lampiranPath && \Storage::disk('public')->exists($lampiranPath)) {
                \Storage::disk('public')->delete($lampiranPath);
            }
            $lampiranPath = $request->file('lampiran')->store('aspirasi_lampiran', 'public');
        }

        $aspirasi->update([
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'isi_aspirasi' => $request->isi,
            'lampiran' => $lampiranPath,
        ]);

        return redirect()->route('masyarakat.aspirasi.index')
            ->with('success', 'Aspirasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())
            ->where('id_aspirasi', $id)
            ->firstOrFail();
        
        if ($aspirasi->status !== 'baru') {
            return redirect()->route('masyarakat.aspirasi.index')
                ->with('error', 'Aspirasi tidak dapat dibatalkan karena sudah diproses!');
        }
        
        if ($aspirasi->lampiran && \Storage::disk('public')->exists($aspirasi->lampiran)) {
            \Storage::disk('public')->delete($aspirasi->lampiran);
        }
        
        $aspirasi->delete();
        
        return redirect()->route('masyarakat.aspirasi.index')
            ->with('success', 'Aspirasi berhasil dibatalkan!');
    }
}