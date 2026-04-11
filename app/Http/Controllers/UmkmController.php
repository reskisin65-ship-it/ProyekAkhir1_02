<?php
// app/Http/Controllers/UmkmController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UmkmController extends Controller
{
    public function dashboard()
    {
        return view('umkm.dashboard');
    }
    
    public function index()
    {
        // Halaman UMKM publik
        return view('pages.umkm');
    }
    
    public function show($id)
    {
        // Detail UMKM
        return view('pages.umkm-detail');
    }
    
    // Method lainnya
    public function requestForm()
    {
        return view('masyarakat.request-umkm');
    }
    
    public function storeRequest(Request $request)
    {
        // Simpan request UMKM
        return back()->with('success', 'Request UMKM berhasil dikirim!');
    }
    
    public function editProfil()
    {
        return view('umkm.profil');
    }
    
    public function updateProfil(Request $request)
    {
        return back()->with('success', 'Profil UMKM berhasil diperbarui!');
    }
    
    public function produkIndex()
    {
        return view('umkm.produk.index');
    }
    
    public function produkCreate()
    {
        return view('umkm.produk.create');
    }
    
    public function produkStore(Request $request)
    {
        return redirect()->route('umkm.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }
    
    public function produkEdit($id)
    {
        return view('umkm.produk.edit');
    }
    
    public function produkUpdate(Request $request, $id)
    {
        return redirect()->route('umkm.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }
    
    public function produkDestroy($id)
    {
        return back()->with('success', 'Produk berhasil dihapus!');
    }
}