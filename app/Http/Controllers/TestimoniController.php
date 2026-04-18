<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'pesan' => 'required|min:5',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        Testimoni::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'pesan' => $request->pesan,
            'rating' => $request->rating ?? 5,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Terima kasih! Testimoni Anda akan ditampilkan setelah disetujui admin.');
    }
}