<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    // Menampilkan daftar semua UMKM di desa
    public function index()
    {
        $umkms = Umkm::with('user')->latest()->get();
        return view('dashboard.admin.umkm.index', compact('umkms'));
    }

    // Menghapus data UMKM jika melanggar aturan
    public function destroy(Umkm $umkm)
    {
        if ($umkm->bukti_usaha) {
            Storage::disk('public')->delete($umkm->bukti_usaha);
        }
        $umkm->delete();
        return redirect()->route('admin.umkm.index')->with('success', 'Data UMKM berhasil dihapus.');
    }
}