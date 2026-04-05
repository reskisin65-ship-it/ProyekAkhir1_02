<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('dashboard.admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('dashboard.admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:191',
            'isi_berita' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kategori' => 'required',
        ]);

        // Upload Foto
        $fotoPath = $request->file('foto')->store('berita', 'public');

        Berita::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'isi_berita' => $request->isi_berita,
            'foto' => $fotoPath,
            'kategori' => $request->kategori,
            'status' => 'publik',
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dipublikasikan!');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->foto) {
            Storage::disk('public')->delete($berita->foto);
        }
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}