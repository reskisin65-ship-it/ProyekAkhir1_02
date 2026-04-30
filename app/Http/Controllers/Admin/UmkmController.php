<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    // Menampilkan halaman pendaftaran UMKM
    public function create()
    {
        return view('umkm.create');
    }

    // FIX: Nama fungsi disamakan dengan rute masyarakat/umkm/store
    public function storeMasyarakat(Request $request)
    {
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'pemilik' => 'required|string|max:255',
            'kategori' => 'required',
            'no_telepon' => 'required',
            'alamat_usaha' => 'required',
            'deskripsi' => 'required',
            'logo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'bukti_usaha' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        // Simpan logo
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('umkm/logos', 'public');
        }

        // Simpan bukti usaha
        if ($request->hasFile('bukti_usaha')) {
            $data['bukti_usaha'] = $request->file('bukti_usaha')->store('bukti_umkm', 'public');
        }

        Umkm::create($data);

        // Redirect balik ke dashboard atau halaman status
        return redirect()->route('umkm.dashboard')->with('success', 'Pendaftaran UMKM berhasil diajukan!');
    }

    // Fungsi tambahan agar rute /umkm/daftar juga tidak error
    public function store(Request $request)
    {
        return $this->storeMasyarakat($request);
    }

    public function dashboard()
    {
        $umkms = Umkm::all(); 
        return view('umkm.dashboard', compact('umkms'));
    }

    public function index()
    {
        $umkms = Umkm::where('status', 'approved')->latest()->get();
        return view('umkm.dashboard', compact('umkms'));
    }

    public function show($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('umkm.show', compact('umkm'));
    }

    public function edit($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('umkm.edit', compact('umkm'));
    }

    public function update(Request $request, $id)
    {
        $umkm = Umkm::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('logo')) {
            if ($umkm->logo) Storage::disk('public')->delete($umkm->logo);
            $data['logo'] = $request->file('logo')->store('umkm/logos', 'public');
        }

        $umkm->update($data);
        return redirect()->route('umkm.dashboard')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        if ($umkm->logo) Storage::disk('public')->delete($umkm->logo);
        $umkm->delete();
        return redirect()->route('umkm.dashboard')->with('success', 'Data UMKM berhasil dihapus');
    }
}