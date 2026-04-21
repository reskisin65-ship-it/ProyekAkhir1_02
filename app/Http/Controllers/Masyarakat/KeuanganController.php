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
        $bulan = $request->bulan ?? date('m');
        $jenis = $request->jenis ?? 'semua';
        
        // Query transaksi yang sudah disetujui
        $query = TransaksiKeuangan::with(['kategori'])
            ->where('status', 'disetujui')
            ->whereYear('tanggal', $tahun);
        
        if ($bulan != 'semua') {
            $query->whereMonth('tanggal', $bulan);
        }
        
        if ($jenis != 'semua') {
            $query->where('jenis', $jenis);
        }
        
        $transaksis = $query->orderBy('tanggal', 'desc')->paginate(15);
        
        // Statistik
        $totalPemasukan = TransaksiKeuangan::where('jenis', 'pemasukan')
            ->where('status', 'disetujui')
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');
        
        $totalPengeluaran = TransaksiKeuangan::where('jenis', 'pengeluaran')
            ->where('status', 'disetujui')
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');
        
        $saldo = $totalPemasukan - $totalPengeluaran;
        
        // Data grafik per bulan
        $grafikData = [];
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