<?php
// app/Http/Controllers/Admin/KeuanganController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKeuangan;
use App\Models\TransaksiKeuangan;
use App\Models\AnggaranTahunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KeuanganController extends Controller
{
    /**
     * Dashboard Keuangan Admin
     */
    public function index(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');
        $bulan = $request->bulan ?? date('m');
        
        // Data pemasukan dan pengeluaran
        $totalPemasukan = TransaksiKeuangan::where('jenis', 'pemasukan')
            ->where('status', 'disetujui')
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');
        
        $totalPengeluaran = TransaksiKeuangan::where('jenis', 'pengeluaran')
            ->where('status', 'disetujui')
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');
        
        $saldo = $totalPemasukan - $totalPengeluaran;
        
        // Data per bulan
        $dataPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pemasukan = TransaksiKeuangan::where('jenis', 'pemasukan')
                ->where('status', 'disetujui')
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $i)
                ->sum('jumlah');
            
            $pengeluaran = TransaksiKeuangan::where('jenis', 'pengeluaran')
                ->where('status', 'disetujui')
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $i)
                ->sum('jumlah');
            
            $dataPerBulan[$i] = [
                'pemasukan' => $pemasukan,
                'pengeluaran' => $pengeluaran,
                'bulan' => date('F', mktime(0, 0, 0, $i, 1))
            ];
        }
        
        // Transaksi terbaru
        $transaksiTerbaru = TransaksiKeuangan::with(['kategori', 'creator'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        // Transaksi pending
        $transaksiPending = TransaksiKeuangan::where('status', 'pending')
            ->with(['kategori', 'creator'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Kategori
        $kategoris = KategoriKeuangan::orderBy('urutan')->get();
        
        return view('admin.keuangan.index', compact(
            'totalPemasukan', 'totalPengeluaran', 'saldo', 'dataPerBulan',
            'transaksiTerbaru', 'transaksiPending', 'kategoris', 'tahun', 'bulan'
        ));
    }
    
    /**
     * Form Tambah Transaksi
     */
    public function create()
    {
        $kategoris = KategoriKeuangan::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.keuangan.create', compact('kategoris'));
    }
    
    /**
     * Simpan Transaksi
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'id_kategori' => 'required|exists:kategori_keuangan,id_kategori',
            'deskripsi' => 'required|min:5',
            'jumlah' => 'required|numeric|min:0',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        
        $buktiPath = null;
        if ($request->hasFile('bukti_foto')) {
            $buktiPath = $request->file('bukti_foto')->store('keuangan/bukti', 'public');
        }
        
        TransaksiKeuangan::create([
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'id_kategori' => $request->id_kategori,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'bukti_foto' => $buktiPath,
            'status' => 'pending',
            'created_by' => Auth::id()
        ]);
        
        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Transaksi berhasil ditambahkan! Menunggu persetujuan.');
    }
    
    /**
     * Approve Transaksi
     */
    public function approve($id)
    {
        $transaksi = TransaksiKeuangan::findOrFail($id);
        $transaksi->update([
            'status' => 'disetujui',
            'approved_by' => Auth::id()
        ]);
        
        return back()->with('success', 'Transaksi berhasil disetujui!');
    }
    
    /**
     * Reject Transaksi
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|min:5'
        ]);
        
        $transaksi = TransaksiKeuangan::findOrFail($id);
        $transaksi->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->catatan,
            'approved_by' => Auth::id()
        ]);
        
        return back()->with('success', 'Transaksi ditolak!');
    }
    
    /**
     * Edit Transaksi
     */
    public function edit($id)
    {
        $transaksi = TransaksiKeuangan::findOrFail($id);
        $kategoris = KategoriKeuangan::where('is_active', true)->orderBy('urutan')->get();
        return view('admin.keuangan.edit', compact('transaksi', 'kategoris'));
    }
    
    /**
     * Update Transaksi
     */
    public function update(Request $request, $id)
    {
        $transaksi = TransaksiKeuangan::findOrFail($id);
        
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'id_kategori' => 'required|exists:kategori_keuangan,id_kategori',
            'deskripsi' => 'required|min:5',
            'jumlah' => 'required|numeric|min:0',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        
        $data = $request->except('bukti_foto');
        
        if ($request->hasFile('bukti_foto')) {
            if ($transaksi->bukti_foto && Storage::disk('public')->exists($transaksi->bukti_foto)) {
                Storage::disk('public')->delete($transaksi->bukti_foto);
            }
            $data['bukti_foto'] = $request->file('bukti_foto')->store('keuangan/bukti', 'public');
        }
        
        $transaksi->update($data);
        
        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Transaksi berhasil diperbarui!');
    }
    
    /**
     * Hapus Transaksi
     */
    public function destroy($id)
    {
        $transaksi = TransaksiKeuangan::findOrFail($id);
        
        if ($transaksi->bukti_foto && Storage::disk('public')->exists($transaksi->bukti_foto)) {
            Storage::disk('public')->delete($transaksi->bukti_foto);
        }
        
        $transaksi->delete();
        
        return back()->with('success', 'Transaksi berhasil dihapus!');
    }
    
    /**
     * Manajemen Kategori
     */
    public function kategori()
    {
        $kategoris = KategoriKeuangan::orderBy('urutan')->get();
        return view('admin.keuangan.kategori', compact('kategoris'));
    }
    
    /**
     * Simpan Kategori
     */
    public function kategoriStore(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_keuangan,nama_kategori',
            'jenis' => 'required|in:pemasukan,pengeluaran'
        ]);
        
        KategoriKeuangan::create($request->all());
        
        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }
    
    /**
     * Update Kategori
     */
    public function kategoriUpdate(Request $request, $id)
    {
        $kategori = KategoriKeuangan::findOrFail($id);
        
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_keuangan,nama_kategori,' . $id . ',id_kategori',
            'jenis' => 'required|in:pemasukan,pengeluaran'
        ]);
        
        $kategori->update($request->all());
        
        return back()->with('success', 'Kategori berhasil diperbarui!');
    }
    
    /**
     * Hapus Kategori
     */
    public function kategoriDestroy($id)
    {
        $kategori = KategoriKeuangan::findOrFail($id);
        
        if ($kategori->transaksis()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki transaksi!');
        }
        
        $kategori->delete();
        
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
    
    /**
     * Laporan Keuangan
     */
    public function laporan(Request $request)
    {
        $dariTanggal = $request->dari_tanggal ?? date('Y-m-01');
        $sampaiTanggal = $request->sampai_tanggal ?? date('Y-m-d');
        
        $transaksis = TransaksiKeuangan::with(['kategori', 'creator', 'approver'])
            ->whereBetween('tanggal', [$dariTanggal, $sampaiTanggal])
            ->where('status', 'disetujui')
            ->orderBy('tanggal', 'desc')
            ->get();
        
        $totalPemasukan = $transaksis->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $transaksis->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;
        
        return view('admin.keuangan.laporan', compact(
            'transaksis', 'totalPemasukan', 'totalPengeluaran', 'saldo',
            'dariTanggal', 'sampaiTanggal'
        ));
    }
}