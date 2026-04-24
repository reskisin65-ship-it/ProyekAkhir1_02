<?php

namespace App\Http\Controllers\umkm;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    /**
     * SESUAIKAN DENGAN web.php: Route baris 30
     */
    public function index()
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        $umkms = Umkm::where('status', 'approved')->latest()->get();
        return view('umkm.index', compact('umkm', 'umkms'));
    }

    /**
     * SESUAIKAN DENGAN web.php: Route baris 84
     */
    public function create()
    {
        return view('umkm.create');
    }

    /**
     * SESUAIKAN DENGAN web.php: Route baris 85
     * Ini yang tadi bikin error karena namanya beda
     */
    public function storeMasyarakat(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'kategori' => 'required',
            'no_telepon' => 'required',
            'alamat_usaha' => 'required',
            'deskripsi' => 'required',
            'bukti_usaha' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        if ($request->hasFile('bukti_usaha')) {
            $data['bukti_usaha'] = $request->file('bukti_usaha')->store('bukti_umkm', 'public');
        }

        Umkm::create($data);

        // Setelah simpan, balik ke halaman umkm.index
        return redirect()->route('umkm')->with('success', 'Pendaftaran UMKM berhasil diajukan! Mohon tunggu konfirmasi admin.');
    }

    /**
     * SESUAIKAN DENGAN web.php: Route baris 95 (Dashboard Merchant)
     */
    public function dashboard()
    {
        $umkm = Umkm::where('user_id', Auth::id())->where('status', 'approved')->firstOrFail();
        return view('umkm.dashboard', compact('umkm'));
    }
}