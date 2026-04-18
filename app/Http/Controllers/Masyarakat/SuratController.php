<?php
// app/Http/Controllers/Masyarakat/SuratController.php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index()
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('masyarakat.surat.index', compact('pengajuan'));
    }

    public function create()
    {
        return view('masyarakat.surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required',
            'nama_lengkap' => 'required|min:3',
            'nik' => 'required|size:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'nomor_telepon' => 'required|max:15',
            'keperluan' => 'required|min:5',
            'keterangan' => 'nullable',
            'berkas_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('berkas_pendukung')) {
            $filePath = $request->file('berkas_pendukung')->store('pendukung_surat', 'public');
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
            'keterangan' => $request->keterangan,
            'berkas_pendukung' => $filePath,
            'status' => 'menunggu',
            'tgl_pengajuan' => now(),
        ]);

        return redirect()->route('masyarakat.surat.index')
            ->with('success', 'Pengajuan surat berhasil dikirim!');
    }

    public function show($id)
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::id())->findOrFail($id);
        return view('masyarakat.surat.show', compact('pengajuan'));
    }

    public function edit($id)
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->findOrFail($id);
        return view('masyarakat.surat.edit', compact('pengajuan'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->findOrFail($id);
        
        $request->validate([
            'jenis_surat' => 'required',
            'nama_lengkap' => 'required|min:3',
            'nik' => 'required|size:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'nomor_telepon' => 'required|max:15',
            'keperluan' => 'required|min:5',
            'keterangan' => 'nullable',
            'berkas_pendukung' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $filePath = $pengajuan->berkas_pendukung;
        if ($request->hasFile('berkas_pendukung')) {
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('berkas_pendukung')->store('pendukung_surat', 'public');
        }

        $pengajuan->update([
            'jenis_surat' => $request->jenis_surat,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_telepon' => $request->nomor_telepon,
            'keperluan' => $request->keperluan,
            'keterangan' => $request->keterangan,
            'berkas_pendukung' => $filePath,
        ]);

        return redirect()->route('masyarakat.surat.index')
            ->with('success', 'Pengajuan surat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->findOrFail($id);
        
        if ($pengajuan->berkas_pendukung && Storage::disk('public')->exists($pengajuan->berkas_pendukung)) {
            Storage::disk('public')->delete($pengajuan->berkas_pendukung);
        }
        
        $pengajuan->delete();

        return redirect()->route('masyarakat.surat.index')
            ->with('success', 'Pengajuan surat berhasil dibatalkan!');
    }

    public function download($id)
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::id())->findOrFail($id);
        
        if (!$pengajuan->file_surat || !Storage::disk('public')->exists($pengajuan->file_surat)) {
            return back()->with('error', 'File surat tidak ditemukan!');
        }
        
        return Storage::disk('public')->download($pengajuan->file_surat, 'Surat_' . $pengajuan->jenis_surat . '.pdf');
    }
}