<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    // Menampilkan semua daftar pengajuan surat dari warga
    public function index()
    {
        $surats = PengajuanSurat::with('user')->latest()->get();
        return view('dashboard.admin.surat.index', compact('surats'));
    }

    // Mengubah status surat (Setujui / Tolak)
    public function updateStatus(Request $request, PengajuanSurat $surat)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
        ]);

        $surat->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status surat berhasil diperbarui menjadi ' . $request->status);
    }

    // Menghapus riwayat surat jika diperlukan
    public function destroy(PengajuanSurat $surat)
    {
        $surat->delete();
        return redirect()->back()->with('success', 'Riwayat surat berhasil dihapus.');
    }
}