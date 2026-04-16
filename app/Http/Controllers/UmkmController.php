<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\ProdukUmkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    /**
     * Halaman UMKM publik (guest)
     */
    public function index()
    {
        $umkms = Umkm::where('status', 'approved')->paginate(9);
        return view('pages.umkm', compact('umkms'));
    }

    /**
     * Detail UMKM publik
     */
    public function show($id)
    {
        $umkm = Umkm::with('produk')->where('status', 'approved')->findOrFail($id);
        $produk = $umkm->produk;
        return view('pages.umkm-detail', compact('umkm', 'produk'));
    }

    // ==============================================
    // METHOD UNTUK MASYARAKAT (PENDAFTARAN)
    // ==============================================

    public function createForm()
    {
        $existingUmkm = Umkm::where('user_id', Auth::id())->first();
        
        if ($existingUmkm) {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Anda sudah memiliki pengajuan UMKM!');
        }
        
        return view('umkm.create');
    }

    public function storeMasyarakat(Request $request)
    {
        $existingUmkm = Umkm::where('user_id', Auth::id())->first();
            
        if ($existingUmkm) {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Anda sudah memiliki pengajuan UMKM!');
        }
        
        $request->validate([
            'nama_usaha' => 'required|min:3|max:100',
            'kategori' => 'required',
            'pemilik' => 'required|min:3',
            'no_telepon' => 'required|max:15',
            'alamat_usaha' => 'required|min:5',
            'deskripsi' => 'required|min:10',
        ]);

        Umkm::create([
            'user_id' => Auth::id(),
            'nama_usaha' => $request->nama_usaha,
            'kategori' => $request->kategori,
            'pemilik' => $request->pemilik,
            'no_telepon' => $request->no_telepon,
            'alamat_usaha' => $request->alamat_usaha,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending',
        ]);

        return redirect()->route('masyarakat.umkm.status')
            ->with('success', 'Pengajuan UMKM berhasil dikirim! Menunggu verifikasi admin.');
    }

    public function statusMasyarakat()
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm) {
            return redirect()->route('masyarakat.umkm.create')
                ->with('info', 'Silakan daftarkan UMKM Anda terlebih dahulu.');
        }
        
        return view('umkm.status', compact('umkm'));
    }

    // ==============================================
    // METHOD UNTUK PEMILIK UMKM (SETELAH APPROVED)
    // ==============================================

    public function produkIndex()
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $umkm->status !== 'approved') {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Akun UMKM Anda belum aktif.');
        }
        
        $produk = $umkm->produk;
        return view('umkm.produk.index', compact('umkm', 'produk'));
    }

    public function produkCreate()
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $umkm->status !== 'approved') {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Akun UMKM Anda belum aktif.');
        }
        
        return view('umkm.produk.create');
    }

    public function produkStore(Request $request)
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $umkm->status !== 'approved') {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Akun UMKM Anda belum aktif.');
        }
        
        $request->validate([
            'nama_produk' => 'required|min:3',
            'deskripsi' => 'required|min:5',
            'harga' => 'required|numeric|min:0',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stok' => 'nullable|integer|min:0',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_produk')) {
            $fotoPath = $request->file('foto_produk')->store('produk_umkm', 'public');
        }

        $umkm->produk()->create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'foto_produk' => $fotoPath,
            'stok' => $request->stok ?? 0,
        ]);

        return redirect()->route('umkm.produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function produkEdit($id)
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $umkm->status !== 'approved') {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Akun UMKM Anda belum aktif.');
        }
        
        $produk = $umkm->produk()->findOrFail($id);
        return view('umkm.produk.edit', compact('umkm', 'produk'));
    }

    public function produkUpdate(Request $request, $id)
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $umkm->status !== 'approved') {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Akun UMKM Anda belum aktif.');
        }
        
        $produk = $umkm->produk()->findOrFail($id);
        
        $request->validate([
            'nama_produk' => 'required|min:3',
            'deskripsi' => 'required|min:5',
            'harga' => 'required|numeric|min:0',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stok' => 'nullable|integer|min:0',
        ]);

        $fotoPath = $produk->foto_produk;
        if ($request->hasFile('foto_produk')) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto_produk')->store('produk_umkm', 'public');
        }

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'foto_produk' => $fotoPath,
            'stok' => $request->stok ?? 0,
        ]);

        return redirect()->route('umkm.produk.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function produkDestroy($id)
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $umkm->status !== 'approved') {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Akun UMKM Anda belum aktif.');
        }
        
        $produk = $umkm->produk()->findOrFail($id);
        
        if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
            Storage::disk('public')->delete($produk->foto_produk);
        }
        
        $produk->delete();
        
        return back()->with('success', 'Produk berhasil dihapus!');
    }

    public function editProfil()
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $umkm->status !== 'approved') {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Akun UMKM Anda belum aktif.');
        }
        
        return view('umkm.profil', compact('umkm'));
    }

    public function updateProfil(Request $request)
    {
        $umkm = Umkm::where('user_id', Auth::id())->first();
        
        if (!$umkm || $umkm->status !== 'approved') {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Akun UMKM Anda belum aktif.');
        }
        
        $request->validate([
            'nama_usaha' => 'required|min:3',
            'kategori' => 'required',
            'no_telepon' => 'required',
            'alamat_usaha' => 'required',
            'deskripsi' => 'required',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $logoPath = $umkm->logo;
        if ($request->hasFile('logo')) {
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $request->file('logo')->store('umkm_logo', 'public');
        }

        $umkm->update([
            'nama_usaha' => $request->nama_usaha,
            'kategori' => $request->kategori,
            'no_telepon' => $request->no_telepon,
            'alamat_usaha' => $request->alamat_usaha,
            'deskripsi' => $request->deskripsi,
            'logo' => $logoPath,
        ]);

        return back()->with('success', 'Profil UMKM berhasil diperbarui!');
    }
}