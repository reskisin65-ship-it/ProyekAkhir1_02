<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Umkm;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\PengajuanSurat;
use App\Models\Aspirasi;
use App\Models\ProfilDesa;
use App\Models\DataPengurus;
use App\Models\DataPenduduk;
use App\Models\Role;
use App\Models\PengaturanStatistik;
use App\Models\Notifikasi; // TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        $totalPenduduk = DataPenduduk::count();
        $totalPengurus = DataPengurus::count();
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $totalUmkm = Umkm::count();
        $umkmPending = Umkm::where('status', 'pending')->count();
        $totalSurat = PengajuanSurat::count();
        $suratMenunggu = PengajuanSurat::where('status', 'menunggu')->count();
        $totalAspirasi = Aspirasi::count();
        $aspirasiBaru = Aspirasi::where('status', 'baru')->count();
        
        $pengajuanTerbaru = PengajuanSurat::with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        $umkmTerbaru = Umkm::with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        $aspirasiTerbaru = Aspirasi::with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        
        return view('admin.dashboard', compact(
            'totalPenduduk', 'totalPengurus', 'totalBerita', 'totalGaleri',
            'totalUmkm', 'umkmPending', 'totalSurat', 'suratMenunggu',
            'totalAspirasi', 'aspirasiBaru', 'pengajuanTerbaru', 
            'umkmTerbaru', 'aspirasiTerbaru'
        ));
    }

    // ==============================================
    // MANAJEMEN ASPIRASI
    // ==============================================

    public function aspirasi()
    {
        $status = request('status', 'all');
        $query = Aspirasi::with('user')->orderBy('created_at', 'desc');
        
        if ($status != 'all') {
            $query->where('status', $status);
        }
        
        $aspirasi = $query->paginate(15);
        
        $statistik = [
            'total' => Aspirasi::count(),
            'baru' => Aspirasi::where('status', 'baru')->count(),
            'diproses' => Aspirasi::where('status', 'diproses')->count(),
            'selesai' => Aspirasi::where('status', 'selesai')->count(),
        ];
        
        return view('admin.aspirasi', compact('aspirasi', 'statistik'));
    }

    public function aspirasiRespond(Request $request, $id)
    {
        $request->validate([
            'respon' => 'required|min:5',
        ]);
        
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'respon_admin' => $request->respon,
            'status' => 'selesai'
        ]);
        
        // KIRIM NOTIFIKASI KE PENGIRIM ASPIRASI
        if ($aspirasi->user_id) {
            Notifikasi::create([
                'user_id' => $aspirasi->user_id,
                'jenis' => 'aspirasi',
                'judul' => '✅ Aspirasi Telah Dijawab',
                'pesan' => 'Aspirasi Anda telah direspon oleh admin desa.',
                'link' => route('masyarakat.aspirasi.show', $aspirasi->id_aspirasi),
                'ref_id' => $aspirasi->id_aspirasi,
                'dibaca' => false
            ]);
        }
        
        return redirect()->route('admin.aspirasi.index')->with('success', 'Respon berhasil dikirim!');
    }

    public function aspirasiStatus($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update(['status' => 'diproses']);
        
        return back()->with('success', 'Status aspirasi diperbarui!');
    }

    public function aspirasiDestroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        
        if ($aspirasi->lampiran && Storage::disk('public')->exists($aspirasi->lampiran)) {
            Storage::disk('public')->delete($aspirasi->lampiran);
        }
        
        $aspirasi->delete();
        
        return back()->with('success', 'Aspirasi berhasil dihapus!');
    }

    // ==============================================
    // MANAJEMEN BERITA
    // ==============================================

    public function berita()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.berita', compact('beritas'));
    }

    public function beritaCreate()
    {
        return view('admin.berita-create');
    }

    public function beritaStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:5',
            'kategori' => 'required',
            'isi_berita' => 'required|min:10',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal_publikasi' => 'required|date',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('berita', 'public');
        }

        Berita::create([
            'user_id' => Auth::user()->user_id,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'ringkasan' => Str::limit($request->isi_berita, 150),
            'isi_berita' => $request->isi_berita,
            'foto' => $fotoPath,
            'status' => $request->status ?? 'publish',
            'tanggal_publikasi' => $request->tanggal_publikasi,
            'slug' => Str::slug($request->judul) . '-' . time(),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function beritaEdit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita-edit', compact('berita'));
    }

    public function beritaUpdate(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|min:5',
            'kategori' => 'required',
            'isi_berita' => 'required|min:10',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal_publikasi' => 'required|date',
        ]);

        $fotoPath = $berita->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('berita', 'public');
        }

        $berita->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'ringkasan' => Str::limit($request->isi_berita, 150),
            'isi_berita' => $request->isi_berita,
            'foto' => $fotoPath,
            'status' => $request->status ?? 'publish',
            'tanggal_publikasi' => $request->tanggal_publikasi,
            'slug' => Str::slug($request->judul) . '-' . time(),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function beritaDestroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
        }
        
        $berita->delete();
        
        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    // ==============================================
    // MANAJEMEN GALERI
    // ==============================================

    public function galeri()
    {
        $galeris = Galeri::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.galeri', compact('galeris'));
    }

    public function galeriCreate()
    {
        return view('admin.galeri-create');
    }

    public function galeriStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:3',
            'kategori' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambarPath = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'judul_galeri' => $request->judul,
            'gambar_galeri' => $gambarPath,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil ditambahkan!');
    }

    public function galeriShow($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri-show', compact('galeri'));
    }

    public function galeriEdit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri-edit', compact('galeri'));
    }

    public function galeriUpdate(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|min:3',
            'kategori' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'judul_galeri' => $request->judul,
            'kategori' => $request->kategori,
        ];

        if ($request->hasFile('foto')) {
            if ($galeri->gambar_galeri && Storage::disk('public')->exists($galeri->gambar_galeri)) {
                Storage::disk('public')->delete($galeri->gambar_galeri);
            }
            $data['gambar_galeri'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui!');
    }

    public function galeriDestroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        if ($galeri->gambar_galeri && Storage::disk('public')->exists($galeri->gambar_galeri)) {
            Storage::disk('public')->delete($galeri->gambar_galeri);
        }
        
        $galeri->delete();
        
        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil dihapus!');
    }

    // ==============================================
    // MANAJEMEN UMKM
    // ==============================================

    public function umkm()
    {
        $umkms = Umkm::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.umkm', compact('umkms'));
    }

    public function umkmApprove($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->update(['status' => 'approved']);
        
        $roleUmkm = Role::where('nama_role', 'umkm')->first();
        if ($roleUmkm) {
            $umkm->user->update(['id_role' => $roleUmkm->id_role]);
        }
        
        // KIRIM NOTIFIKASI KE PEMILIK UMKM
        if ($umkm->user_id) {
            Notifikasi::create([
                'user_id' => $umkm->user_id,
                'jenis' => 'umkm',
                'judul' => '✅ UMKM Disetujui',
                'pesan' => 'Pendaftaran UMKM ' . $umkm->nama_usaha . ' Anda telah disetujui.',
                'link' => route('umkm.show', $umkm->id_umkm),
                'ref_id' => $umkm->id_umkm,
                'dibaca' => false
            ]);
        }
        
        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil disetujui!');
    }

    public function umkmReject($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->update(['status' => 'rejected']);
        
        // KIRIM NOTIFIKASI KE PEMILIK UMKM
        if ($umkm->user_id) {
            Notifikasi::create([
                'user_id' => $umkm->user_id,
                'jenis' => 'umkm',
                'judul' => '❌ UMKM Ditolak',
                'pesan' => 'Pendaftaran UMKM ' . $umkm->nama_usaha . ' Anda ditolak. Silakan hubungi admin.',
                'link' => route('umkm.show', $umkm->id_umkm),
                'ref_id' => $umkm->id_umkm,
                'dibaca' => false
            ]);
        }
        
        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM ditolak!');
    }

    public function umkmDestroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        
        if ($umkm->logo && Storage::disk('public')->exists($umkm->logo)) {
            Storage::disk('public')->delete($umkm->logo);
        }
        
        foreach ($umkm->produk as $produk) {
            if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
        }
        
        $umkm->delete();
        
        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil dihapus!');
    }

    // ==============================================
    // MANAJEMEN PENGAJUAN SURAT
    // ==============================================

    public function pengajuanSurat()
    {
        $status = request('status', 'all');
        $query = PengajuanSurat::with('user')->orderBy('created_at', 'desc');
        
        if ($status != 'all') {
            $query->where('status', $status);
        }
        
        $pengajuan = $query->paginate(15);
        
        $statistik = [
            'total' => PengajuanSurat::count(),
            'menunggu' => PengajuanSurat::where('status', 'menunggu')->count(),
            'diproses' => PengajuanSurat::where('status', 'diproses')->count(),
            'selesai' => PengajuanSurat::where('status', 'selesai')->count(),
            'ditolak' => PengajuanSurat::where('status', 'ditolak')->count(),
        ];
        
        return view('admin.pengajuan-surat', compact('pengajuan', 'statistik'));
    }

    public function pengajuanSuratShow($id)
    {
        $pengajuan = PengajuanSurat::with('user')->findOrFail($id);
        return view('admin.pengajuan-surat-show', compact('pengajuan'));
    }

    public function pengajuanSuratApprove($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update(['status' => 'diproses']);
        
        // KIRIM NOTIFIKASI KE PEMOHON
        if ($pengajuan->user_id) {
            Notifikasi::create([
                'user_id' => $pengajuan->user_id,
                'jenis' => 'pengajuan_surat',
                'judul' => '🔄 Pengajuan Surat Diproses',
                'pesan' => 'Pengajuan surat ' . $pengajuan->jenis_surat . ' Anda sedang diproses oleh admin.',
                'link' => route('masyarakat.surat.show', $pengajuan->id_surat),
                'ref_id' => $pengajuan->id_surat,
                'dibaca' => false
            ]);
        }
        
        return back()->with('success', 'Pengajuan surat diterima dan sedang diproses!');
    }

    public function pengajuanSuratComplete(Request $request, $id)
    {
        $request->validate([
            'file_surat' => 'required|file|mimes:pdf|max:2048',
        ]);
        
        $pengajuan = PengajuanSurat::findOrFail($id);
        
        $filePath = $request->file('file_surat')->store('surat_selesai', 'public');
        
        $pengajuan->update([
            'status' => 'selesai',
            'file_surat' => $filePath,
        ]);
        
        // KIRIM NOTIFIKASI SURAT SELESAI
        if ($pengajuan->user_id) {
            Notifikasi::create([
                'user_id' => $pengajuan->user_id,
                'jenis' => 'pengajuan_surat',
                'judul' => '✅ Surat Selesai',
                'pesan' => 'Surat ' . $pengajuan->jenis_surat . ' Anda telah selesai. Silakan download.',
                'link' => route('masyarakat.surat.show', $pengajuan->id_surat),
                'ref_id' => $pengajuan->id_surat,
                'dibaca' => false
            ]);
        }
        
        return redirect()->route('admin.pengajuan-surat.index')
            ->with('success', 'Surat selesai dan telah diunggah!');
    }

    public function pengajuanSuratReject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|min:5',
        ]);
        
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update([
            'status' => 'ditolak',
            'catatan_penolakan' => $request->catatan,
        ]);
        
        // KIRIM NOTIFIKASI PENOLAKAN
        if ($pengajuan->user_id) {
            Notifikasi::create([
                'user_id' => $pengajuan->user_id,
                'jenis' => 'pengajuan_surat',
                'judul' => '❌ Pengajuan Surat Ditolak',
                'pesan' => 'Pengajuan surat ' . $pengajuan->jenis_surat . ' ditolak. Catatan: ' . $request->catatan,
                'link' => route('masyarakat.surat.show', $pengajuan->id_surat),
                'ref_id' => $pengajuan->id_surat,
                'dibaca' => false
            ]);
        }
        
        return back()->with('success', 'Pengajuan surat ditolak!');
    }

    public function pengajuanSuratDestroy($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        
        if ($pengajuan->berkas_pendukung && Storage::disk('public')->exists($pengajuan->berkas_pendukung)) {
            Storage::disk('public')->delete($pengajuan->berkas_pendukung);
        }
        if ($pengajuan->file_surat && Storage::disk('public')->exists($pengajuan->file_surat)) {
            Storage::disk('public')->delete($pengajuan->file_surat);
        }
        
        $pengajuan->delete();
        
        return redirect()->route('admin.pengajuan-surat.index')
            ->with('success', 'Pengajuan surat berhasil dihapus!');
    }

    public function pengajuanSuratDownload($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        
        if (!$pengajuan->file_surat || !Storage::disk('public')->exists($pengajuan->file_surat)) {
            return back()->with('error', 'File surat tidak ditemukan!');
        }
        
        return Storage::disk('public')->download($pengajuan->file_surat, 'Surat_' . $pengajuan->jenis_surat . '.pdf');
    }

    public function pengajuanSuratDownloadPendukung($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        
        if (!$pengajuan->berkas_pendukung || !Storage::disk('public')->exists($pengajuan->berkas_pendukung)) {
            return back()->with('error', 'File pendukung tidak ditemukan!');
        }
        
        return Storage::disk('public')->download($pengajuan->berkas_pendukung, 'Pendukung_' . $pengajuan->jenis_surat . '.pdf');
    }

    // ==============================================
    // MANAJEMEN DATA PENDUDUK
    // ==============================================

    public function penduduk()
    {
        $penduduk = DataPenduduk::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.penduduk', compact('penduduk'));
    }

    public function pendudukCreate()
    {
        $roleMasyarakat = Role::where('nama_role', 'masyarakat')->first();
        $users = User::when($roleMasyarakat, function($query) use ($roleMasyarakat) {
            return $query->where('id_role', $roleMasyarakat->id_role);
        })->get();
        
        return view('admin.penduduk-create', compact('users'));
    }

    public function pendudukStore(Request $request)
    {
        $request->validate([
            'nik' => 'required|size:16|unique:data_penduduk,nik',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_perkawinan' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'kelurahan_desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten_kota' => 'required',
            'provinsi' => 'required',
            'status_keluarga' => 'required',
        ]);

        DataPenduduk::create($request->all());

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan!');
    }

    public function pendudukEdit($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        $roleMasyarakat = Role::where('nama_role', 'masyarakat')->first();
        $users = User::when($roleMasyarakat, function($query) use ($roleMasyarakat) {
            return $query->where('id_role', $roleMasyarakat->id_role);
        })->get();
        
        return view('admin.penduduk-edit', compact('penduduk', 'users'));
    }

    public function pendudukUpdate(Request $request, $id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        
        $request->validate([
            'nik' => 'required|size:16|unique:data_penduduk,nik,' . $id . ',id_penduduk',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_perkawinan' => 'required',
            'alamat' => 'required',
            'rt_rw' => 'required',
            'kelurahan_desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten_kota' => 'required',
            'provinsi' => 'required',
            'status_keluarga' => 'required',
        ]);

        $penduduk->update($request->all());

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil diperbarui!');
    }

    public function pendudukDestroy($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        $penduduk->delete();
        
        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil dihapus!');
    }

    // ==============================================
    // MANAJEMEN DATA PENGURUS (APARATUR DESA)
    // ==============================================

    public function pengurus()
    {
        $pengurus = DataPengurus::orderBy('id_pengurus', 'asc')->paginate(15);
        return view('admin.pengurus', compact('pengurus'));
    }

    public function pengurusCreate()
    {
        return view('admin.pengurus-create');
    }

    public function pengurusStore(Request $request)
    {
        $request->validate([
            'nama_pengurus' => 'required|min:3|max:100',
            'jabatan' => 'required|min:3|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengurus', 'public');
        }

        DataPengurus::create([
            'nama_pengurus' => $request->nama_pengurus,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil ditambahkan!');
    }

    public function pengurusEdit($id)
    {
        $pengurus = DataPengurus::findOrFail($id);
        return view('admin.pengurus-edit', compact('pengurus'));
    }

    public function pengurusUpdate(Request $request, $id)
    {
        $pengurus = DataPengurus::findOrFail($id);
        
        $request->validate([
            'nama_pengurus' => 'required|min:3|max:100',
            'jabatan' => 'required|min:3|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = $pengurus->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('pengurus', 'public');
        }

        $pengurus->update([
            'nama_pengurus' => $request->nama_pengurus,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil diperbarui!');
    }

    public function pengurusDestroy($id)
    {
        $pengurus = DataPengurus::findOrFail($id);
        
        if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
            Storage::disk('public')->delete($pengurus->foto);
        }
        
        $pengurus->delete();
        
        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil dihapus!');
    }

    // ==============================================
    // MANAJEMEN PROFIL DESA
    // ==============================================

    public function profilDesa()
    {
        $profil = ProfilDesa::first();
        return view('admin.profil-desa', compact('profil'));
    }

    public function updateProfilDesa(Request $request)
    {
        $profil = ProfilDesa::first();
        
        $request->validate([
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
        ]);

        if ($profil) {
            $profil->update($request->all());
        } else {
            ProfilDesa::create($request->all());
        }

        return redirect()->route('admin.profil-desa')
            ->with('success', 'Profil desa berhasil diperbarui!');
    }

    // ==============================================
    // MANAJEMEN STATISTIK
    // ==============================================

    public function statistik()
    {
        $statistik = [
            'total_penduduk' => DataPenduduk::count(),
            'penduduk_pria' => DataPenduduk::where('jenis_kelamin', 'L')->count(),
            'penduduk_wanita' => DataPenduduk::where('jenis_kelamin', 'P')->count(),
            'total_kk' => DataPenduduk::where('status_keluarga', 'Kepala Keluarga')->count(),
            'kelompok_umur_0_14' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 14')->count(),
            'kelompok_umur_15_29' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 29')->count(),
            'kelompok_umur_30_59' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 59')->count(),
            'kelompok_umur_60' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60')->count(),
            'total_umkm' => Umkm::count(),
            'umkm_approved' => Umkm::where('status', 'approved')->count(),
            'total_berita' => Berita::count(),
            'total_aspirasi' => Aspirasi::count(),
            'total_surat' => PengajuanSurat::count(),
        ];
        
        return view('admin.statistik', compact('statistik'));
    }

    public function statistikKelola()
    {
        $realtime = [
            'total_penduduk' => DataPenduduk::count(),
            'laki_laki' => DataPenduduk::where('jenis_kelamin', 'L')->count(),
            'perempuan' => DataPenduduk::where('jenis_kelamin', 'P')->count(),
            'kepala_keluarga' => DataPenduduk::where('status_keluarga', 'Kepala Keluarga')->count(),
            'kelompok_umur_0_14' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 14')->count(),
            'kelompok_umur_15_29' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 29')->count(),
            'kelompok_umur_30_59' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 59')->count(),
            'kelompok_umur_60' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60')->count(),
            'total_umkm' => Umkm::count(),
            'umkm_aktif' => Umkm::where('status', 'approved')->count(),
            'total_surat' => PengajuanSurat::count(),
            'total_aspirasi' => Aspirasi::count(),
            'total_berita' => Berita::count(),
        ];
        
        $pengaturan = PengaturanStatistik::all()->keyBy('key');
        
        return view('admin.statistik.kelola', compact('realtime', 'pengaturan'));
    }

    public function statistikUpdate(Request $request)
    {
        $keys = [
            'total_penduduk', 'laki_laki', 'perempuan', 'kepala_keluarga',
            'kelompok_umur_0_14', 'kelompok_umur_15_29', 'kelompok_umur_30_59', 'kelompok_umur_60',
            'total_umkm', 'umkm_aktif', 'total_surat', 'total_aspirasi', 'total_berita'
        ];
        
        foreach ($keys as $key) {
            $mode = $request->input("mode_{$key}", 'otomatis');
            $nilai = $request->input($key);
            
            if ($mode == 'manual' && $nilai !== null) {
                PengaturanStatistik::updateOrCreate(
                    ['key' => $key],
                    ['nilai_awal' => $nilai, 'mode' => 'manual']
                );
            } elseif ($mode == 'hybrid' && $nilai !== null) {
                PengaturanStatistik::updateOrCreate(
                    ['key' => $key],
                    ['nilai_awal' => $nilai, 'mode' => 'hybrid']
                );
            } else {
                PengaturanStatistik::where('key', $key)->delete();
            }
        }
        
        return redirect()->route('admin.statistik.kelola')->with('success', 'Pengaturan statistik berhasil disimpan!');
    }
}