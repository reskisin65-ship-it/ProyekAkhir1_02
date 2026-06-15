<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKeuangan;
use App\Models\TransaksiKeuangan;
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
        
        $applyFilters = function($query) use ($request, $tahun) {
            $query->whereYear('tanggal', $tahun);
            if ($request->filled('dari_tanggal')) $query->whereDate('tanggal', '>=', $request->dari_tanggal);
            if ($request->filled('sampai_tanggal')) $query->whereDate('tanggal', '<=', $request->sampai_tanggal);
            if ($request->filled('bulan')) $query->whereMonth('tanggal', $request->bulan);
            if ($request->filled('jenis')) $query->where('jenis', $request->jenis);
            if ($request->filled('kategori')) $query->where('id_kategori', $request->kategori);
            return $query;
        };

        $totalPemasukan = $applyFilters(TransaksiKeuangan::where('jenis', 'pemasukan'))->sum('jumlah');
        $totalPengeluaran = $applyFilters(TransaksiKeuangan::where('jenis', 'pengeluaran'))->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $dataPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $pq = TransaksiKeuangan::where('jenis', 'pemasukan')->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i);
            $eq = TransaksiKeuangan::where('jenis', 'pengeluaran')->whereYear('tanggal', $tahun)->whereMonth('tanggal', $i);
            if ($request->filled('dari_tanggal')) { $pq->whereDate('tanggal', '>=', $request->dari_tanggal); $eq->whereDate('tanggal', '>=', $request->dari_tanggal); }
            if ($request->filled('sampai_tanggal')) { $pq->whereDate('tanggal', '<=', $request->sampai_tanggal); $eq->whereDate('tanggal', '<=', $request->sampai_tanggal); }
            if ($request->filled('kategori')) { $pq->where('id_kategori', $request->kategori); $eq->where('id_kategori', $request->kategori); }

            $dataPerBulan[$i] = [
                'pemasukan'  => (!$request->filled('jenis') || $request->jenis === 'pemasukan') ? $pq->sum('jumlah') : 0,
                'pengeluaran'=> (!$request->filled('jenis') || $request->jenis === 'pengeluaran') ? $eq->sum('jumlah') : 0,
                'bulan'      => date('F', mktime(0, 0, 0, $i, 1)),
            ];
        }

        $query = TransaksiKeuangan::with(['kategori', 'creator']);
        if ($request->filled('dari_tanggal')) $query->whereDate('tanggal', '>=', $request->dari_tanggal);
        if ($request->filled('sampai_tanggal')) $query->whereDate('tanggal', '<=', $request->sampai_tanggal);
        if ($request->filled('bulan')) $query->whereMonth('tanggal', $request->bulan);
        if ($request->filled('tahun')) $query->whereYear('tanggal', $request->tahun);
        if ($request->filled('jenis')) $query->where('jenis', $request->jenis);
        if ($request->filled('kategori')) $query->where('id_kategori', $request->kategori);

        $transaksiTerbaru = $query->orderBy('tanggal', 'desc')->paginate(15);
        $kategoris = KategoriKeuangan::orderBy('urutan')->get();

        return view('admin.keuangan.index', compact(
            'totalPemasukan', 'totalPengeluaran', 'saldo', 'dataPerBulan',
            'transaksiTerbaru', 'kategoris', 'tahun'
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
     * Simpan Transaksi — langsung aktif, tanpa approval
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
            'id_kategori'=> 'required|exists:kategori_keuangan,id_kategori',
            'deskripsi'  => 'required|min:5',
            'jumlah'     => 'required|numeric|min:0',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $buktiPath = null;
        if ($request->hasFile('bukti_foto')) {
            $buktiPath = $request->file('bukti_foto')->store('keuangan/bukti', 'public');
        }

        TransaksiKeuangan::create([
            'tanggal'     => $request->tanggal,
            'jenis'       => $request->jenis,
            'id_kategori' => $request->id_kategori,
            'deskripsi'   => $request->deskripsi,
            'jumlah'      => $request->jumlah,
            'bukti_foto'  => $buktiPath,
            'created_by'  => Auth::id(),
        ]);

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Detail transaksi
     */
    public function show($id)
    {
        $transaksi = TransaksiKeuangan::with(['kategori', 'creator'])->findOrFail($id);
        return view('admin.keuangan.show', compact('transaksi'));
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
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:pemasukan,pengeluaran',
            'id_kategori'=> 'required|exists:kategori_keuangan,id_kategori',
            'deskripsi'  => 'required|min:5',
            'jumlah'     => 'required|numeric|min:0',
            'bukti_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['tanggal', 'jenis', 'id_kategori', 'deskripsi', 'jumlah']);

        if ($request->hasFile('bukti_foto')) {
            if ($transaksi->bukti_foto && Storage::disk('public')->exists($transaksi->bukti_foto)) {
                Storage::disk('public')->delete($transaksi->bukti_foto);
            }
            $data['bukti_foto'] = $request->file('bukti_foto')->store('keuangan/bukti', 'public');
        }

        $transaksi->update($data);

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
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
        return back()->with('success', 'Transaksi berhasil dihapus.');
    }

    /**
     * Manajemen Kategori
     */
    public function kategori()
    {
        $kategoris = KategoriKeuangan::orderBy('urutan')->get();
        return view('admin.keuangan.kategori', compact('kategoris'));
    }

    public function kategoriStore(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_keuangan,nama_kategori',
            'jenis'         => 'required|in:pemasukan,pengeluaran',
        ]);
        KategoriKeuangan::create(array_merge($request->all(), ['user_id' => Auth::id()]));
        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriUpdate(Request $request, $id)
    {
        $kategori = KategoriKeuangan::findOrFail($id);
        $request->validate([
            'nama_kategori' => 'required|unique:kategori_keuangan,nama_kategori,' . $id . ',id_kategori',
            'jenis'         => 'required|in:pemasukan,pengeluaran',
        ]);
        $kategori->update($request->all());
        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function kategoriDestroy($id)
    {
        $kategori = KategoriKeuangan::findOrFail($id);
        if ($kategori->transaksis()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki transaksi.');
        }
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Laporan Keuangan
     */
    public function laporan(Request $request)
    {
        $dariTanggal   = $request->dari_tanggal ?? date('Y-m-01');
        $sampaiTanggal = $request->sampai_tanggal ?? date('Y-m-d');

        $transaksis = TransaksiKeuangan::with(['kategori', 'creator'])
            ->whereBetween('tanggal', [$dariTanggal, $sampaiTanggal])
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalPemasukan  = $transaksis->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran= $transaksis->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('admin.keuangan.laporan', compact(
            'transaksis', 'totalPemasukan', 'totalPengeluaran', 'saldo',
            'dariTanggal', 'sampaiTanggal'
        ));
    }
}