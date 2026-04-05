<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Models\Berita;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    // Menampilkan Dashboard Masyarakat yang lengkap dengan konten Home
    public function dashboard()
    {
        $beritas = Berita::where('status', 'publik')->latest()->take(3)->get();
        $about = About::first();
        $recentSurats = PengajuanSurat::where('user_id', Auth::id())->latest()->take(3)->get();

        return view('dashboard.masyarakat', compact('beritas', 'about', 'recentSurats'));
    }

    public function index()
    {
        $surats = PengajuanSurat::where('user_id', Auth::id())->latest()->get();
        return view('dashboard.masyarakat.surat.index', compact('surats'));
    }

    public function create()
    {
        return view('dashboard.masyarakat.surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required',
            'keperluan' => 'required|string',
            'nama_berkas' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:2048',
        ]);

        $namaBerkas = null;
        if ($request->hasFile('nama_berkas')) {
            $namaBerkas = $request->file('nama_berkas')->store('berkas_surat', 'public');
        }

        PengajuanSurat::create([
            'user_id' => Auth::id(),
            'nik' => Auth::user()->penduduk->nik ?? '0',
            'jenis_surat' => $request->jenis_surat,
            'keperluan' => $request->keperluan,
            'status' => 'pending',
            'tgl_pengajuan' => now(),
            'nama_berkas' => $namaBerkas,
        ]);

        return redirect()->route('masyarakat.surat.index')->with('success', 'Surat berhasil diajukan!');
    }

    public function edit(PengajuanSurat $surat)
    {
        // Hanya bisa edit jika status masih pending
        if ($surat->status !== 'pending') {
            return redirect()->back()->with('error', 'Surat yang sedang diproses tidak bisa diubah.');
        }
        return view('dashboard.masyarakat.surat.edit', compact('surat'));
    }

    public function update(Request $request, PengajuanSurat $surat)
    {
        $request->validate([
            'jenis_surat' => 'required',
            'keperluan' => 'required|string',
        ]);

        $data = [
            'jenis_surat' => $request->jenis_surat,
            'keperluan' => $request->keperluan,
        ];

        if ($request->hasFile('nama_berkas')) {
            if ($surat->nama_berkas) Storage::disk('public')->delete($surat->nama_berkas);
            $data['nama_berkas'] = $request->file('nama_berkas')->store('berkas_surat', 'public');
        }

        $surat->update($data);
        return redirect()->route('masyarakat.surat.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(PengajuanSurat $surat)
    {
        if ($surat->nama_berkas) Storage::disk('public')->delete($surat->nama_berkas);
        $surat->delete();
        return redirect()->route('masyarakat.surat.index')->with('success', 'Pengajuan dibatalkan.');
    }
}