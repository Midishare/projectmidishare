<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;

class HistoryController extends Controller
{
    // Form untuk menambahkan history baru (akses admin)
    public function create()
    {
        $users = User::all(); // Mendapatkan daftar semua pengguna
        return view('admin.history.create', compact('users'));
    }

    // Menyimpan history baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'history' => 'required|string',
        ]);

        // Hapus semua history yang lama untuk user_id yang sama
        History::where('user_id', $request->user_id)->delete();

        // Buat history baru
        $historybaru = new History();
        $historybaru->user_id = $request->user_id;
        $historybaru->history = $request->history;
        $historybaru->save();

        return redirect()->route('history.create')->with('success', 'History belajar berhasil ditambahkan.');
    }


    // Menampilkan history untuk pengguna
    public function showUserRekomendasi()
    {
        $history = auth()->user()->history; // Mengambil history berdasarkan pengguna
        return view('history', compact('history'));
    }

    public function gethistory(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Ambil history yang sesuai dengan user_id
        $history = History::where('user_id', $request->user_id)->first();

        return response()->json([
            'history' => $history ? $history->history : ''
        ]);
    }
}
