<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Umkm; // Import model Umkm
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menyimpan produk baru
    public function store(Request $request)
    {
        // 1. Ambil data UMKM berdasarkan ID yang dikirim dari form
        $umkm = Umkm::findOrFail($request->umkm_id);

        // 2. CEK KEAMANAN: Pastikan status UMKM sudah 'approved'
        if ($umkm->status !== 'approved') {
            return back()->with('error', 'Maaf, fitur tambah produk hanya tersedia untuk UMKM yang sudah disetujui oleh Admin.');
        }

        // 3. Validasi input
        $request->validate([
            'umkm_id' => 'required',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable',
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        // 4. Proses Upload Foto Produk
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        // 5. Simpan ke database
        Product::create($data);

        return back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Hapus foto dari storage jika ada agar tidak memenuhi server
        if ($product->foto) {
            Storage::disk('public')->delete($product->foto);
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus!');
    }
}