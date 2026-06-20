<?php
// app/Http/Controllers/Masyarakat/KeuanganController.php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\TransaksiKeuangan;
use App\Models\KategoriKeuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');
        $bulan = $request->bulan ?? 'semua';
        $jenis = $request->jenis ?? 'semua';

        // ── tabel transaksi ──────────────────────────────────────────────────
        $query = TransaksiKeuangan::with(['kategori'])->whereYear('tanggal', $tahun);
        if ($request->filled('dari_tanggal'))  $query->whereDate('tanggal', '>=', $request->dari_tanggal);
        if ($request->filled('sampai_tanggal')) $query->whereDate('tanggal', '<=', $request->sampai_tanggal);
        if ($bulan !== 'semua')                 $query->whereMonth('tanggal', $bulan);
        if ($jenis !== 'semua')                 $query->where('jenis', $jenis);
        if ($request->filled('kategori'))       $query->where('id_kategori', $request->kategori);

        $transaksis = $query->orderBy('tanggal', 'desc')->paginate(15)->withQueryString();

        // ── summary cards ────────────────────────────────────────────────────
        $statsQuery = TransaksiKeuangan::whereYear('tanggal', $tahun);
        if ($request->filled('dari_tanggal'))  $statsQuery->whereDate('tanggal', '>=', $request->dari_tanggal);
        if ($request->filled('sampai_tanggal')) $statsQuery->whereDate('tanggal', '<=', $request->sampai_tanggal);
        if ($bulan !== 'semua')                 $statsQuery->whereMonth('tanggal', $bulan);
        if ($request->filled('kategori'))       $statsQuery->where('id_kategori', $request->kategori);

        $totalPemasukan   = (clone $statsQuery)->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = (clone $statsQuery)->where('jenis', 'pengeluaran')->sum('jumlah');
        // Jika filter jenis aktif, sesuaikan display
        if ($jenis === 'pemasukan')   $totalPengeluaran = 0;
        if ($jenis === 'pengeluaran') $totalPemasukan   = 0;
        $saldo = $totalPemasukan - $totalPengeluaran;

        // ── data grafik per bulan ────────────────────────────────────────────
        $grafikData = [];
        for ($i = 1; $i <= 12; $i++) {
            $gq = TransaksiKeuangan::whereYear('tanggal', $tahun)->whereMonth('tanggal', $i);
            if ($request->filled('dari_tanggal'))  $gq->whereDate('tanggal', '>=', $request->dari_tanggal);
            if ($request->filled('sampai_tanggal')) $gq->whereDate('tanggal', '<=', $request->sampai_tanggal);
            if ($request->filled('kategori'))       $gq->where('id_kategori', $request->kategori);

            $grafikData[$i] = [
                'bulan'       => date('F', mktime(0, 0, 0, $i, 1)),
                'pemasukan'   => ($jenis === 'semua' || $jenis === 'pemasukan')   ? (clone $gq)->where('jenis', 'pemasukan')->sum('jumlah')   : 0,
                'pengeluaran' => ($jenis === 'semua' || $jenis === 'pengeluaran') ? (clone $gq)->where('jenis', 'pengeluaran')->sum('jumlah') : 0,
            ];
        }

        $kategoris = KategoriKeuangan::where('is_active', true)->get();

        return view('masyarakat.keuangan.index', compact(
            'transaksis', 'totalPemasukan', 'totalPengeluaran', 'saldo',
            'grafikData', 'kategoris', 'tahun', 'bulan', 'jenis'
        ));
    }

    public function show($id)
    {
        $transaksi = TransaksiKeuangan::with(['kategori', 'creator'])->findOrFail($id);
        return view('masyarakat.keuangan.show', compact('transaksi'));
    }
}
