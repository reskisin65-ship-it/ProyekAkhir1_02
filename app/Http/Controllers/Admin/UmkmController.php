<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\ProdukUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    /**
     * Menampilkan halaman utama UMKM (index)
     */
    public function index()
    {
        $umkms = Umkm::where('status', 'approved')->latest()->paginate(9);
        return view('umkm.index', compact('umkms'));
    }

    /**
     * Menampilkan halaman pendaftaran UMKM
     */
    public function create()
    {
        return view('umkm.create');
    }

    /**
     * Menampilkan form pendaftaran UMKM (alternatif)
     */
    public function createForm()
    {
        return view('umkm.create');
    }

    /**
     * Menyimpan data pendaftaran UMKM dari masyarakat
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
            'logo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'bukti_usaha' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('umkm/logos', 'public');
        }

        if ($request->hasFile('bukti_usaha')) {
            $data['bukti_usaha'] = $request->file('bukti_usaha')->store('bukti_umkm', 'public');
        }

        Umkm::create($data);

        return redirect()->route('umkm.dashboard')->with('success', 'Pendaftaran UMKM berhasil diajukan!');
    }

    /**
     * Store method untuk route umkm.store
     */
    public function store(Request $request)
    {
        return $this->storeMasyarakat($request);
    }

    /**
     * Menampilkan halaman status pengajuan UMKM
     */
    public function status()
    {
        $umkms = Umkm::where('user_id', auth()->id())->latest()->get();
        
        if ($umkms->isEmpty()) {
            return redirect()->route('umkm.index')->with('error', 'Anda belum mendaftarkan UMKM.');
        }
        
        return view('umkm.status', compact('umkms'));
    }

    /**
     * Menampilkan halaman status untuk masyarakat (multiple UMKM)
     */
    public function statusMasyarakat()
    {
        $umkms = Umkm::where('user_id', auth()->id())->latest()->get();
        
        if ($umkms->isEmpty()) {
            return redirect()->route('masyarakat.dashboard')->with('error', 'Anda belum mendaftarkan UMKM.');
        }
        
        return view('umkm.status', compact('umkms'));
    }

    /**
     * Dashboard UMKM (redirect ke index)
     */
    public function dashboard()
    {
        return redirect()->route('umkm.index');
    }

    /**
     * Menampilkan detail UMKM
     */
    public function show($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('umkm.show', compact('umkm'));
    }

    /**
     * Menampilkan form edit UMKM
     */
    public function edit($id)
    {
        $umkm = Umkm::findOrFail($id);
        
        if ($umkm->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('umkm.edit', compact('umkm'));
    }

    /**
     * Update data UMKM
     */
    public function update(Request $request, $id)
    {
        $umkm = Umkm::findOrFail($id);
        
        if ($umkm->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'kategori' => 'required',
            'no_telepon' => 'required',
            'alamat_usaha' => 'required',
            'deskripsi' => 'required',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'pemilik']);
        
        if ($request->hasFile('logo')) {
            if ($umkm->logo) {
                Storage::disk('public')->delete($umkm->logo);
            }
            $data['logo'] = $request->file('logo')->store('umkm/logos', 'public');
        }

        $umkm->update($data);
        
        return redirect()->route('masyarakat.umkm.status')->with('success', 'Data UMKM berhasil diperbarui!');
    }

    /**
     * Update profil UMKM (alternatif untuk multiple UMKMs)
     */
    public function updateProfil(Request $request)
    {
        $umkmId = $request->input('umkm_id');
        
        if ($umkmId) {
            $umkm = Umkm::findOrFail($umkmId);
        } else {
            $umkm = Umkm::where('user_id', Auth::id())->first();
        }
        
        if (!$umkm || $umkm->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'UMKM tidak ditemukan atau tidak memiliki akses');
        }
        
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'kategori' => 'required',
            'no_telepon' => 'required',
            'alamat_usaha' => 'required',
            'deskripsi' => 'required',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'umkm_id']);
        
        if ($request->hasFile('logo')) {
            if ($umkm->logo) {
                Storage::disk('public')->delete($umkm->logo);
            }
            $data['logo'] = $request->file('logo')->store('umkm/logos', 'public');
        }

        $umkm->update($data);
        
        return redirect()->back()->with('success', 'Profil UMKM berhasil diperbarui');
    }

    /**
     * Hapus UMKM (Batalkan Pengajuan)
     */
    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        
        if ($umkm->user_id != Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }
        
        if ($umkm->logo) {
            Storage::disk('public')->delete($umkm->logo);
        }
        
        if ($umkm->bukti_usaha) {
            Storage::disk('public')->delete($umkm->bukti_usaha);
        }
        
        $umkm->delete();
        
        return redirect()->route('umkm.index')->with('success', 'Pengajuan UMKM berhasil dibatalkan.');
    }

    /**
     * Menampilkan form edit profil UMKM (multiple UMKMs)
     */
    public function editProfil()
    {
        $umkms = Umkm::where('user_id', Auth::id())->latest()->get();
        
        if ($umkms->isEmpty()) {
            return redirect()->route('umkm.create')->with('error', 'Silakan daftarkan UMKM terlebih dahulu');
        }
        
        // Get first UMKM as default, or user can select another
        $umkm = $umkms->first();
        
        return view('umkm.edit', compact('umkm', 'umkms'));
    }

    /**
     * ==============================================
     * MANAJEMEN PRODUK UMKM
     * ==============================================
     */

    /**
     * Menampilkan daftar produk UMKM (multiple UMKMs support)
     */
    public function produkIndex($umkmId = null)
    {
        if ($umkmId) {
            $umkm = Umkm::where('id_umkm', $umkmId)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();
        } else {
            $umkm = Umkm::where('user_id', Auth::id())->first();
            
            if (!$umkm) {
                return redirect()->route('umkm.create')->with('error', 'Silakan daftarkan UMKM terlebih dahulu');
            }
        }
        
        $umkms = Umkm::where('user_id', Auth::id())->latest()->get();
        $produk = $umkm->products()->latest()->get();
        
        return view('umkm.produk.index', compact('umkm', 'umkms', 'produk'));
    }

    /**
     * Menampilkan form tambah produk (multiple UMKMs support)
     */
    public function produkCreate($umkmId = null)
    {
        if ($umkmId) {
            $umkm = Umkm::where('id_umkm', $umkmId)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();
        } else {
            $umkm = Umkm::where('user_id', Auth::id())->first();
            
            if (!$umkm) {
                return redirect()->route('umkm.create')->with('error', 'Silakan daftarkan UMKM terlebih dahulu');
            }
        }
        
        if ($umkm->status != 'approved') {
            return redirect()->back()->with('error', 'UMKM Anda belum disetujui oleh admin');
        }
        
        $umkms = Umkm::where('user_id', Auth::id())->where('status', 'approved')->latest()->get();
        
        return view('umkm.produk.create', compact('umkm', 'umkms'));
    }

    /**
     * Menyimpan produk baru (support multiple UMKMs)
     */
    public function produkStore(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto_produk' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'umkm_id' => 'nullable|numeric',
        ]);

        // Get UMKM ID from form or use first UMKM
        $umkmId = $request->input('umkm_id');
        
        if ($umkmId) {
            $umkm = Umkm::where('id_umkm', $umkmId)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();
        } else {
            $umkm = Umkm::where('user_id', Auth::id())->first();
        }
        
        if (!$umkm) {
            return redirect()->back()->with('error', 'UMKM tidak ditemukan');
        }

        if ($umkm->status != 'approved') {
            return redirect()->back()->with('error', 'UMKM Anda belum disetujui oleh admin');
        }

        $data = [
            'umkm_id' => $umkm->id_umkm,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->input('deskripsi', ''),
        ];

        if ($request->hasFile('foto_produk')) {
            $data['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
        }

        ProdukUmkm::create($data);

        return redirect()->route('umkm.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit produk
     */
    public function produkEdit($id)
    {
        $produk = ProdukUmkm::findOrFail($id);
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $produk->umkm_id != $umkm->id_umkm) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('umkm.produk.edit', compact('produk', 'umkm'));
    }

    /**
     * Update produk
     */
    public function produkUpdate(Request $request, $id)
    {
        $produk = ProdukUmkm::findOrFail($id);
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $produk->umkm_id != $umkm->id_umkm) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto_produk' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = [
            'nama_produk' => $validated['nama_produk'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'] ?? '',
        ];

        if ($request->hasFile('foto_produk')) {
            if ($produk->foto_produk) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
            $data['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
        }

        $produk->update($data);

        return redirect()->route('umkm.produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Hapus produk
     */
    public function produkDestroy($id)
    {
        $produk = ProdukUmkm::findOrFail($id);
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $produk->umkm_id != $umkm->id_umkm) {
            abort(403, 'Unauthorized action.');
        }
        
        if ($produk->foto_produk) {
            Storage::disk('public')->delete($produk->foto_produk);
        }
        
        $produk->delete();
        
        return redirect()->route('umkm.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}