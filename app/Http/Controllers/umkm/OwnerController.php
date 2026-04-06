<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\ProdukUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $umkm = Umkm::where('user_id', $user->id)->first();

        // Jika belum punya profil UMKM, arahkan ke pendaftaran usaha
        if (!$umkm) {
            return view('dashboard.umkm.register_usaha');
        }

        $produkCount = ProdukUmkm::where('umkm_id', $umkm->id)->count();
        return view('dashboard.umkm.index', compact('umkm', 'produkCount'));
    }

    public function storeUsaha(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required|max:100',
            'kategori' => 'required',
            'no_telepon' => 'required',
            'alamat_usaha' => 'required',
        ]);

        Umkm::create([
            'user_id' => Auth::id(),
            'nama_role' => Auth::user()->role->nama_role, // Tambahan jika perlu
            'nama_usaha' => $request->nama_usaha,
            'kategori' => $request->kategori,
            'no_telepon' => $request->no_telepon,
            'alamat_usaha' => $request->alamat_usaha,
            'status_aktif' => true
        ]);

        return redirect()->route('umkm.dashboard')->with('success', 'Usaha berhasil didaftarkan!');
    }
}