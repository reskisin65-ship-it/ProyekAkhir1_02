<?php
// app/Http/Controllers/Masyarakat/SuratController.php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    public function index()
    {
        $surat = PengajuanSurat::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('masyarakat.surat.index', compact('surat'));
    }

    public function create()
    {
        return view('masyarakat.surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required|size:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'nomor_telepon' => 'required',
            'keperluan' => 'required',
        ]);

        $berkasPath = null;
        if ($request->hasFile('berkas_pendukung')) {
            $berkasPath = $request->file('berkas_pendukung')->store('berkas_surat', 'public');
        }

        PengajuanSurat::create([
            'user_id' => Auth::id(),
            'jenis_surat' => $request->jenis_surat,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_telepon' => $request->nomor_telepon,
            'keperluan' => $request->keperluan,
            'berkas_pendukung' => $berkasPath,
            'status' => 'menunggu',
            'tgl_pengajuan' => now(),
        ]);

        return redirect()->route('masyarakat.surat.index')
            ->with('success', 'Pengajuan surat berhasil dikirim!');
    }

    /**
     * Tampilkan form edit surat (hanya jika status masih 'menunggu')
     */
    public function edit($id)
    {
        $surat = PengajuanSurat::where('user_id', Auth::id())
            ->where('id_surat', $id)
            ->firstOrFail();
        
        // Hanya bisa edit jika status masih 'menunggu'
        if ($surat->status !== 'menunggu') {
            return redirect()->route('masyarakat.surat.index')
                ->with('error', 'Surat tidak dapat diedit karena sudah diproses!');
        }
        
        return view('masyarakat.surat.edit', compact('surat'));
    }

    /**
     * Update data surat (hanya jika status masih 'menunggu')
     */
    public function update(Request $request, $id)
    {
        $surat = PengajuanSurat::where('user_id', Auth::id())
            ->where('id_surat', $id)
            ->firstOrFail();
        
        // Hanya bisa update jika status masih 'menunggu'
        if ($surat->status !== 'menunggu') {
            return redirect()->route('masyarakat.surat.index')
                ->with('error', 'Surat tidak dapat diedit karena sudah diproses!');
        }
        
        $request->validate([
            'jenis_surat' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required|size:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'nomor_telepon' => 'required',
            'keperluan' => 'required',
        ]);

        // Upload berkas baru jika ada
        $berkasPath = $surat->berkas_pendukung;
        if ($request->hasFile('berkas_pendukung')) {
            // Hapus berkas lama jika ada
            if ($berkasPath && \Storage::disk('public')->exists($berkasPath)) {
                \Storage::disk('public')->delete($berkasPath);
            }
            $berkasPath = $request->file('berkas_pendukung')->store('berkas_surat', 'public');
        }

        $surat->update([
            'jenis_surat' => $request->jenis_surat,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_telepon' => $request->nomor_telepon,
            'keperluan' => $request->keperluan,
            'berkas_pendukung' => $berkasPath,
        ]);

        return redirect()->route('masyarakat.surat.index')
            ->with('success', 'Pengajuan surat berhasil diperbarui!');
    }

    /**
     * Batalkan/Hapus surat (hanya jika status masih 'menunggu')
     */
    public function destroy($id)
    {
        $surat = PengajuanSurat::where('user_id', Auth::id())
            ->where('id_surat', $id)
            ->firstOrFail();
        
        // Hanya bisa hapus jika status masih 'menunggu'
        if ($surat->status !== 'menunggu') {
            return redirect()->route('masyarakat.surat.index')
                ->with('error', 'Surat tidak dapat dibatalkan karena sudah diproses!');
        }
        
        // Hapus berkas jika ada
        if ($surat->berkas_pendukung && \Storage::disk('public')->exists($surat->berkas_pendukung)) {
            \Storage::disk('public')->delete($surat->berkas_pendukung);
        }
        
        $surat->delete();
        
        return redirect()->route('masyarakat.surat.index')
            ->with('success', 'Pengajuan surat berhasil dibatalkan!');
    }

    public function show($id)
    {
        $surat = PengajuanSurat::where('user_id', Auth::id())
            ->where('id_surat', $id)
            ->firstOrFail();
        
        return view('masyarakat.surat.show', compact('surat'));
    }

    public function download($id)
    {
        $surat = PengajuanSurat::where('user_id', Auth::id())
            ->where('id_surat', $id)
            ->firstOrFail();
        
        // Logika download file surat
        return back()->with('info', 'Fitur download sedang dalam pengembangan');
    }
}