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
        $beritas = Berita::orderBy('created_at', 'desc')->get();
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
        $umkms = Umkm::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.umkm', compact('umkms'));
    }

    public function umkmApprove($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->update(['status' => 'approved']);
        
        $roleUmkm = \App\Models\Role::where('nama_role', 'umkm')->first();
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
        
        if ($umkm->bukti_usaha && Storage::disk('public')->exists($umkm->bukti_usaha)) {
            Storage::disk('public')->delete($umkm->bukti_usaha);
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
        $pengajuan = PengajuanSurat::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.pengajuan-surat', compact('pengajuan'));
    }

    public function pengajuanSuratShow($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        return response()->json($pengajuan);
    }

    public function pengajuanSuratApprove($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update(['status' => 'diproses']);
        
        return back()->with('success', 'Pengajuan surat diproses!');
    }

    public function pengajuanSuratComplete($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update(['status' => 'selesai']);
        
        return back()->with('success', 'Pengajuan surat selesai!');
    }

    public function pengajuanSuratReject(Request $request, $id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update([
            'status' => 'ditolak',
            'catatan_penolakan' => $request->catatan
        ]);
        
        return back()->with('success', 'Pengajuan surat ditolak!');
    }

    // ==============================================
    // MANAJEMEN ASPIRASI
    // ==============================================

    public function aspirasi()
    {
        $aspirasi = Aspirasi::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.aspirasi', compact('aspirasi'));
    }

    public function aspirasiRespond(Request $request, $id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'respon' => $request->respon,
            'status' => 'selesai'
        ]);
        
        return back()->with('success', 'Aspirasi berhasil ditanggapi!');
    }

    public function aspirasiStatus($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update(['status' => 'diproses']);
        
        return back()->with('success', 'Status aspirasi diperbarui!');
    }

    // ==============================================
// MANAJEMEN DATA PENDUDUK
// ==============================================

public function penduduk()
{
    $penduduk = DataPenduduk::orderBy('created_at', 'desc')->get();
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
        $pengurus = DataPengurus::orderBy('urutan')->get();
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
        $statistik = [
            'total_penduduk' => DataPenduduk::count(),
            'penduduk_pria' => DataPenduduk::where('jenis_kelamin', 'L')->count(),
            'penduduk_wanita' => DataPenduduk::where('jenis_kelamin', 'P')->count(),
            'total_kk' => DataPenduduk::where('status_keluarga', 'Kepala Keluarga')->count(),
            'total_umkm' => Umkm::count(),
            'umkm_approved' => Umkm::where('status', 'approved')->count(),
            'total_berita' => Berita::count(),
            'total_aspirasi' => Aspirasi::count(),
            'total_surat' => PengajuanSurat::count(),
        ];
        
        return view('admin.statistik', compact('statistik'));
    }
}