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
        $dariTanggal = $request->dari_tanggal;
        $sampaiTanggal = $request->sampai_tanggal;
        $kategori = $request->kategori;
        
        // Query transaksi yang sudah disetujui
        $query = TransaksiKeuangan::with(['kategori'])
            ->where('status', 'disetujui')
            ->whereYear('tanggal', $tahun);
        
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tanggal', '>=', $dariTanggal);
        }
        
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tanggal', '<=', $sampaiTanggal);
        }
        
        if ($bulan != 'semua') {
            $query->whereMonth('tanggal', $bulan);
        }
        
        if ($jenis != 'semua') {
            $query->where('jenis', $jenis);
        }
        
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $kategori);
        }
        
        $transaksis = $query->orderBy('tanggal', 'desc')->paginate(15);
        
        // Statistik
        $statsQuery = TransaksiKeuangan::where('status', 'disetujui')
            ->whereYear('tanggal', $tahun);
        
        if ($request->filled('dari_tanggal')) {
            $statsQuery->whereDate('tanggal', '>=', $dariTanggal);
        }
        
        if ($request->filled('sampai_tanggal')) {
            $statsQuery->whereDate('tanggal', '<=', $sampaiTanggal);
        }
        
        if ($request->filled('kategori')) {
            $statsQuery->where('id_kategori', $kategori);
        }
        
        if ($jenis != 'semua') {
            $statsQuery->where('jenis', $jenis);
        }
        
        $totalPemasukan = (clone $statsQuery)->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = (clone $statsQuery)->where('jenis', 'pengeluaran')->sum('jumlah');
        
        $saldo = $totalPemasukan - $totalPengeluaran;
        
        // Data grafik per bulan
        $grafikData = [];
        for ($i = 1; $i <= 12; $i++) {
            $grafikQuery = TransaksiKeuangan::where('status', 'disetujui')
                ->whereMonth('tanggal', $i)
                ->whereYear('tanggal', $tahun);
            
            if ($request->filled('bulan') && $bulan !== 'semua') {
                $grafikQuery->whereMonth('tanggal', $bulan);
            }
            
            if ($request->filled('dari_tanggal')) {
                $grafikQuery->whereDate('tanggal', '>=', $dariTanggal);
            }
            
            if ($request->filled('sampai_tanggal')) {
                $grafikQuery->whereDate('tanggal', '<=', $sampaiTanggal);
            }
            
            if ($request->filled('kategori')) {
                $grafikQuery->where('id_kategori', $kategori);
            }
            
            $pemasukan = 0;
            $pengeluaran = 0;
            
            if ($jenis === 'semua' || $jenis === 'pemasukan') {
                $pemasukan = (clone $grafikQuery)->where('jenis', 'pemasukan')->sum('jumlah');
            }
            
            if ($jenis === 'semua' || $jenis === 'pengeluaran') {
                $pengeluaran = (clone $grafikQuery)->where('jenis', 'pengeluaran')->sum('jumlah');
            }
            
            $grafikData[$i] = [
                'bulan' => date('F', mktime(0, 0, 0, $i, 1)),
                'pemasukan' => $pemasukan,
                'pengeluaran' => $pengeluaran
            ];
        }
        
        // Kategori untuk filter
        $kategoris = KategoriKeuangan::where('is_active', true)->get();
        
        return view('masyarakat.keuangan.index', compact(
            'transaksis', 'totalPemasukan', 'totalPengeluaran', 'saldo',
            'grafikData', 'kategoris', 'tahun', 'bulan', 'jenis'
        ));
    }
    
    public function show($id)
    {
        $transaksi = TransaksiKeuangan::with(['kategori', 'creator', 'approver'])
            ->where('status', 'disetujui')
            ->findOrFail($id);
        
        return view('masyarakat.keuangan.show', compact('transaksi'));
    }
}