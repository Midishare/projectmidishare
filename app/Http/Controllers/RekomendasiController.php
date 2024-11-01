<?php

namespace App\Http\Controllers;

use App\Models\RekomendasiBelajar;
use App\Models\User;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    // Form untuk menambahkan rekomendasi baru (akses admin)
    public function create()
    {
        $users = User::all(); // Mendapatkan daftar semua pengguna
        return view('admin.rekomendasi.create', compact('users'));
    }

    // Menyimpan rekomendasi baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rekomendasi' => 'required|string',
        ]);

        // Hapus semua rekomendasi yang lama untuk user_id yang sama
        RekomendasiBelajar::where('user_id', $request->user_id)->delete();

        // Buat rekomendasi baru
        $rekomendasiBaru = new RekomendasiBelajar();
        $rekomendasiBaru->user_id = $request->user_id;
        $rekomendasiBaru->rekomendasi = $request->rekomendasi;
        $rekomendasiBaru->save();

        return redirect()->route('rekomendasi.create')->with('success', 'Rekomendasi belajar berhasil ditambahkan.');
    }


    // Menampilkan rekomendasi untuk pengguna
    public function showUserRekomendasi()
    {
        $rekomendasi = auth()->user()->rekomendasiBelajar; // Mengambil rekomendasi berdasarkan pengguna
        return view('rekomendasi', compact('rekomendasi'));
    }

    public function getRekomendasi(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Ambil rekomendasi yang sesuai dengan user_id
        $rekomendasi = RekomendasiBelajar::where('user_id', $request->user_id)->first();

        return response()->json([
            'rekomendasi' => $rekomendasi ? $rekomendasi->rekomendasi : ''
        ]);
    }
}
