<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AspirasiController extends Controller
{
    public function index()
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
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
            'judul' => 'required|min:5|max:255',
            'isi' => 'required|min:10',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('aspirasi-lampiran', 'public');
        }

        $aspirasi = Aspirasi::create([
            'user_id' => Auth::id(),
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'isi_aspirasi' => $request->isi,
            'lampiran' => $lampiranPath,
            'status' => 'baru'
        ]);

        // Kirim notifikasi ke semua admin
        $admins = User::whereHas('role', function($q) {
            $q->where('nama_role', 'admin');
        })->get();

        foreach ($admins as $admin) {
            Notifikasi::create([
                'user_id' => $admin->user_id,
                'jenis' => 'aspirasi',
                'judul' => '💭 Aspirasi Baru dari ' . Auth::user()->name,
                'pesan' => 'Aspirasi baru (' . $request->kategori . '): ' . Str::limit($request->judul, 50),
                'link' => route('admin.aspirasi.show', $aspirasi->id_aspirasi),
                'ref_id' => $aspirasi->id_aspirasi,
                'dibaca' => false
            ]);
        }

        return redirect()->route('masyarakat.aspirasi.index')
            ->with('success', 'Aspirasi berhasil dikirim! Akan segera ditanggapi.');
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
            ->where('status', 'baru')
            ->firstOrFail();
        
        return view('masyarakat.aspirasi.edit', compact('aspirasi'));
    }

    public function update(Request $request, $id)
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())
            ->where('id_aspirasi', $id)
            ->where('status', 'baru')
            ->firstOrFail();

        $request->validate([
            'kategori' => 'required|in:saran,keluhan,masukan,pertanyaan',
            'judul' => 'required|min:5|max:255',
            'isi' => 'required|min:10',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $data = [
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'isi_aspirasi' => $request->isi,
        ];

        if ($request->hasFile('lampiran')) {
            if ($aspirasi->lampiran) {
                Storage::disk('public')->delete($aspirasi->lampiran);
            }
            $data['lampiran'] = $request->file('lampiran')->store('aspirasi-lampiran', 'public');
        }

        $aspirasi->update($data);

        return redirect()->route('masyarakat.aspirasi.index')
            ->with('success', 'Aspirasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())
            ->where('id_aspirasi', $id)
            ->where('status', 'baru')
            ->firstOrFail();

        if ($aspirasi->lampiran) {
            Storage::disk('public')->delete($aspirasi->lampiran);
        }

        $aspirasi->delete();

        return redirect()->route('masyarakat.aspirasi.index')
            ->with('success', 'Aspirasi berhasil dibatalkan!');
    }
}