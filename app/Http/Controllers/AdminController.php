<?php

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
use Illuminate\Http\Request;
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
            'isi' => 'required|min:10',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal_publikasi' => 'required|date',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('berita', 'public');
        }

        Berita::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'ringkasan' => Str::limit($request->isi, 150),
            'isi_berita' => $request->isi,
            'foto' => $fotoPath,
            'status' => $request->status ?? 'publish',
            'tanggal_publikasi' => $request->tanggal_publikasi,
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
            'isi' => 'required|min:10',
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
            'ringkasan' => Str::limit($request->isi, 150),
            'isi_berita' => $request->isi,
            'foto' => $fotoPath,
            'status' => $request->status ?? 'publish',
            'tanggal_publikasi' => $request->tanggal_publikasi,
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
        
        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil disetujui!');
    }

    public function umkmReject($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->update(['status' => 'rejected']);
        
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
// MANAJEMEN PENGAJUAN SURAT (ADMIN)
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
    
    return back()->with('success', 'Pengajuan surat ditolak!');
}

public function pengajuanSuratDestroy($id)
{
    $pengajuan = PengajuanSurat::findOrFail($id);
    
    // PERBAIKAN: gunakan berkas_pendukung
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
    
    // PERBAIKAN: gunakan berkas_pendukung
    if (!$pengajuan->berkas_pendukung || !Storage::disk('public')->exists($pengajuan->berkas_pendukung)) {
        return back()->with('error', 'File pendukung tidak ditemukan!');
    }
    
    return Storage::disk('public')->download($pengajuan->berkas_pendukung, 'Pendukung_' . $pengajuan->jenis_surat . '.pdf');
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
            'respon' => $request->respon,
            'status' => 'selesai'
        ]);
        
        return back()->with('success', 'Respon berhasil dikirim!');
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
        $aspirasi->delete();
        
        return back()->with('success', 'Aspirasi berhasil dihapus!');
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
    // MANAJEMEN DATA PENGURUS
    // ==============================================

    public function pengurus()
    {
        $pengurus = DataPengurus::orderBy('urutan')->paginate(15);
        return view('admin.pengurus', compact('pengurus'));
    }

    public function pengurusCreate()
    {
        return view('admin.pengurus-create');
    }

    public function pengurusStore(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengurus', 'public');
        }

        DataPengurus::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
            'nip' => $request->nip,
            'tugas' => $request->tugas,
            'urutan' => $request->urutan ?? 0,
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
            'nama' => 'required',
            'jabatan' => 'required',
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
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
            'nip' => $request->nip,
            'tugas' => $request->tugas,
            'urutan' => $request->urutan ?? 0,
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
    // STATISTIK
    // ==============================================

    public function statistik()
    {
        // Data Penduduk
        $totalPenduduk = DataPenduduk::count();
        $pendudukPria = DataPenduduk::where('jenis_kelamin', 'L')->count();
        $pendudukWanita = DataPenduduk::where('jenis_kelamin', 'P')->count();
        $totalKK = DataPenduduk::where('status_keluarga', 'Kepala Keluarga')->count();
        
        // Kelompok Umur
        $kelompokUmur0_14 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 14')->count();
        $kelompokUmur15_29 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 29')->count();
        $kelompokUmur30_59 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 59')->count();
        $kelompokUmur60 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60')->count();
        
        // UMKM
        $totalUmkm = Umkm::count();
        $umkmApproved = Umkm::where('status', 'approved')->count();
        
        // Layanan
        $totalBerita = Berita::count();
        $totalAspirasi = Aspirasi::count();
        $totalSurat = PengajuanSurat::count();
        
        $statistik = [
            'total_penduduk' => $totalPenduduk,
            'penduduk_pria' => $pendudukPria,
            'penduduk_wanita' => $pendudukWanita,
            'total_kk' => $totalKK,
            'kelompok_umur_0_14' => $kelompokUmur0_14,
            'kelompok_umur_15_29' => $kelompokUmur15_29,
            'kelompok_umur_30_59' => $kelompokUmur30_59,
            'kelompok_umur_60' => $kelompokUmur60,
            'total_umkm' => $totalUmkm,
            'umkm_approved' => $umkmApproved,
            'total_berita' => $totalBerita,
            'total_aspirasi' => $totalAspirasi,
            'total_surat' => $totalSurat,
        ];
        
        return view('admin.statistik', compact('statistik'));
    }
}