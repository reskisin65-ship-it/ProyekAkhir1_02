<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Product;
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
        // Tampilkan UMKM yang sudah approved untuk umum
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

        // Simpan logo
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('umkm/logos', 'public');
        }

        // Simpan bukti usaha
        if ($request->hasFile('bukti_usaha')) {
            $data['bukti_usaha'] = $request->file('bukti_usaha')->store('bukti_umkm', 'public');
        }

        Umkm::create($data);

        // Redirect ke dashboard atau halaman status
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
        $umkm = Umkm::where('user_id', auth()->id())->first();
        
        if (!$umkm) {
            return redirect()->route('umkm.index')->with('error', 'Anda belum mendaftarkan UMKM.');
        }
        
        return view('umkm.status', compact('umkm'));
    }

    /**
     * Menampilkan halaman status untuk masyarakat
     */
    public function statusMasyarakat()
    {
        $umkm = Umkm::where('user_id', auth()->id())->first();
        
        if (!$umkm) {
            return redirect()->route('masyarakat.dashboard')->with('error', 'Anda belum mendaftarkan UMKM.');
        }
        
        return view('umkm.status', compact('umkm'));
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
        
        // Cek kepemilikan
        if ($umkm->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('umkm.edit', compact('umkm'));
    }

    /**
     * Update data UMKM
     */
    /**
 * Update data UMKM
 */
public function update(Request $request, $id)
{
    $umkm = Umkm::findOrFail($id);
    
    // Cek kepemilikan
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
    
    // Update logo jika ada
    if ($request->hasFile('logo')) {
        if ($umkm->logo) {
            Storage::disk('public')->delete($umkm->logo);
        }
        $data['logo'] = $request->file('logo')->store('umkm/logos', 'public');
    }

    $umkm->update($data);
    
    // Redirect ke halaman status masyarakat
    return redirect()->route('masyarakat.umkm.status')->with('success', 'Data UMKM berhasil diperbarui!');
}

    /**
     * Update profil UMKM (alternatif)
     */
    public function updateProfil(Request $request)
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm) {
            return redirect()->back()->with('error', 'UMKM tidak ditemukan');
        }
        
        $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'kategori' => 'required',
            'no_telepon' => 'required',
            'alamat_usaha' => 'required',
            'deskripsi' => 'required',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);
        
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
     * Hapus UMKM
     */
   /**
 * Hapus UMKM (Batalkan Pengajuan)
 */
public function destroy($id)
{
    $umkm = Umkm::findOrFail($id);
    
    // Cek kepemilikan
    if ($umkm->user_id != Auth::id() && !Auth::user()->hasRole('admin')) {
        abort(403, 'Unauthorized action.');
    }
    
    // Hapus logo
    if ($umkm->logo) {
        Storage::disk('public')->delete($umkm->logo);
    }
    
    // Hapus bukti usaha
    if ($umkm->bukti_usaha) {
        Storage::disk('public')->delete($umkm->bukti_usaha);
    }
    
    $umkm->delete();
    
    // Redirect ke halaman index UMKM
    return redirect()->route('umkm')->with('success', 'Pengajuan UMKM berhasil dibatalkan.');
}

    /**
     * Menampilkan form edit profil UMKM
     */
    public function editProfil()
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm) {
            return redirect()->route('umkm.create')->with('error', 'Silakan daftarkan UMKM terlebih dahulu');
        }
        
        return view('umkm.edit', compact('umkm'));
    }

    /**
     * Menampilkan daftar produk UMKM
     */
    public function produkIndex()
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm) {
            return redirect()->route('umkm.create')->with('error', 'Silakan daftarkan UMKM terlebih dahulu');
        }
        
        $produk = $umkm->products()->latest()->get();
        
        return view('umkm.produk.index', compact('umkm', 'produk'));
    }

    /**
     * Menampilkan form tambah produk
     */
    public function produkCreate()
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm) {
            return redirect()->route('umkm.create')->with('error', 'Silakan daftarkan UMKM terlebih dahulu');
        }
        
        if ($umkm->status != 'approved') {
            return redirect()->back()->with('error', 'UMKM Anda belum disetujui oleh admin');
        }
        
        return view('umkm.produk.create', compact('umkm'));
    }

    /**
     * Menyimpan produk baru
     */
    public function produkStore(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto_produk' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm) {
            return redirect()->back()->with('error', 'UMKM tidak ditemukan');
        }

        $data = $request->all();
        $data['umkm_id'] = $umkm->id_umkm;

        if ($request->hasFile('foto_produk')) {
            $data['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
        }

        Product::create($data);

        return redirect()->route('umkm.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit produk
     */
    public function produkEdit($id)
    {
        $produk = Product::findOrFail($id);
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
        $produk = Product::findOrFail($id);
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $produk->umkm_id != $umkm->id_umkm) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto_produk' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);

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
    $umkm = Umkm::findOrFail($id);
    
    // Cek kepemilikan
    if ($umkm->user_id != Auth::id() && !Auth::user()->hasRole('admin')) {
        abort(403, 'Unauthorized action.');
    }
    
    // Hapus logo
    if ($umkm->logo) {
        Storage::disk('public')->delete($umkm->logo);
    }
    
    // Hapus bukti usaha
    if ($umkm->bukti_usaha) {
        Storage::disk('public')->delete($umkm->bukti_usaha);
    }
    
    $umkm->delete();
    
    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('umkm.index')->with('success', 'Pengajuan UMKM berhasil dibatalkan.');
}
}