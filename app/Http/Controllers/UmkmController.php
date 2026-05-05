<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\ProdukUmkm;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        
        if ($existingUmkm && in_array($existingUmkm->status, ['pending', 'approved'])) {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Anda sudah memiliki pengajuan UMKM yang sedang diproses atau sudah aktif.');
        }
        
        return view('umkm.create');
    }

    public function storeMasyarakat(Request $request)
    {
        $existingUmkm = Umkm::where('user_id', Auth::id())->first();
        
        if ($existingUmkm && in_array($existingUmkm->status, ['pending', 'approved'])) {
            return redirect()->route('masyarakat.umkm.status')
                ->with('error', 'Anda sudah memiliki pengajuan UMKM yang sedang diproses atau sudah aktif.');
        }

        $request->validate([
            'nama_usaha' => 'required|min:3|max:100',
            'kategori' => 'required',
            'pemilik' => 'required|min:3',
            'no_telepon' => 'required|max:15',
            'alamat_usaha' => 'required|min:5',
            'deskripsi' => 'required|min:10',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'bukti_usaha' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'nama_usaha' => $request->nama_usaha,
            'kategori' => $request->kategori,
            'pemilik' => $request->pemilik,
            'no_telepon' => $request->no_telepon,
            'alamat_usaha' => $request->alamat_usaha,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending',
        ];

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('umkm/logos', 'public');
        }

        if ($request->hasFile('bukti_usaha')) {
            $data['bukti_usaha'] = $request->file('bukti_usaha')->store('umkm/bukti_usaha', 'public');
        }

        if ($existingUmkm && $existingUmkm->status === 'rejected') {
            if (!empty($existingUmkm->logo) && isset($data['logo']) && Storage::disk('public')->exists($existingUmkm->logo)) {
                Storage::disk('public')->delete($existingUmkm->logo);
            }
            if (!empty($existingUmkm->bukti_usaha) && isset($data['bukti_usaha']) && Storage::disk('public')->exists($existingUmkm->bukti_usaha)) {
                Storage::disk('public')->delete($existingUmkm->bukti_usaha);
            }

            $existingUmkm->update($data);
            $umkm = $existingUmkm;
        } else {
            $umkm = Umkm::create($data);
        }

        $admins = User::whereHas('role', function($q) {
            $q->where('nama_role', 'admin');
        })->get();

        foreach ($admins as $admin) {
            Notifikasi::create([
                'user_id' => $admin->user_id,
                'jenis' => 'umkm',
                'judul' => '🏪 Pendaftaran UMKM Baru',
                'pesan' => Auth::user()->name . ' mendaftar UMKM: ' . $request->nama_usaha,
                'link' => route('admin.umkm.index'),
                'ref_id' => $umkm->id_umkm,
                'dibaca' => false,
            ]);
        }

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