<?php

namespace App\Http\Controllers;

use App\Models\RekomendasiBelajar;
use App\Models\User;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('admin.rekomendasi.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rekomendasi' => 'required|string',
        ]);
        RekomendasiBelajar::where('user_id', $request->user_id)->delete();
        $rekomendasiBaru = new RekomendasiBelajar();
        $rekomendasiBaru->user_id = $request->user_id;
        $rekomendasiBaru->rekomendasi = $request->rekomendasi;
        $rekomendasiBaru->save();

        return redirect()->route('rekomendasi.create')->with('success', 'Rekomendasi belajar berhasil ditambahkan.');
    }


    public function showUserRekomendasi()
    {
        $rekomendasi = auth()->user()->rekomendasiBelajar;
        return view('rekomendasi', compact('rekomendasi'));
    }

    public function getRekomendasi(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        $rekomendasi = RekomendasiBelajar::where('user_id', $request->user_id)->first();

        return response()->json([
            'rekomendasi' => $rekomendasi ? $rekomendasi->rekomendasi : ''
        ]);
    }
}
