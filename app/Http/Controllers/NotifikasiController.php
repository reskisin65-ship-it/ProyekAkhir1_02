<?php
// app/Http/Controllers/NotifikasiController.php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotifikasiController extends Controller
{
    // JANGAN ADA CONSTRUCTOR DENGAN MIDDLEWARE

    public function index()
    {
        $notifikasi = Notifikasi::where('user_id', Auth::user()->user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('notifikasi.index', compact('notifikasi'));
    }

    public function ambil()
    {
        try {
            $userId = Auth::user()->user_id;
            
            $notifikasi = Notifikasi::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'jenis' => $item->jenis,
                        'judul' => $item->judul,
                        'pesan' => $item->pesan,
                        'link' => $item->link,
                        'dibaca' => $item->dibaca,
                        'waktu' => $item->created_at->diffForHumans()
                    ];
                });
            
            $totalBelumDibaca = Notifikasi::where('user_id', $userId)
                ->where('dibaca', false)
                ->count();
            
            return response()->json([
                'data' => $notifikasi,
                'total' => $totalBelumDibaca
            ]);
        } catch (\Exception $e) {
            Log::error('Error ambil notifikasi: ' . $e->getMessage());
            return response()->json(['data' => [], 'total' => 0]);
        }
    }
    
    public function baca(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:notifikasi,id'
            ]);
            
            $notif = Notifikasi::where('user_id', Auth::user()->user_id)
                ->where('id', $request->id)
                ->first();
            
            if ($notif) {
                $notif->update(['dibaca' => true]);
                return response()->json(['success' => true]);
            }
            
            return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan'], 404);
        } catch (\Exception $e) {
            Log::error('Error baca notifikasi: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function bacaSemua()
    {
        try {
            Notifikasi::where('user_id', Auth::user()->user_id)
                ->where('dibaca', false)
                ->update(['dibaca' => true]);
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error baca semua notifikasi: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function hapus($id)
    {
        try {
            $notif = Notifikasi::where('user_id', Auth::user()->user_id)
                ->where('id', $id)
                ->first();
            
            if ($notif) {
                $notif->delete();
                return response()->json(['success' => true]);
            }
            
            return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan'], 404);
        } catch (\Exception $e) {
            Log::error('Error hapus notifikasi: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function hapusSemua()
    {
        try {
            Notifikasi::where('user_id', Auth::user()->user_id)->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error hapus semua notifikasi: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}