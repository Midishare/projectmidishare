<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Bukupintarwh;
use App\Models\Videobukupintarwh;
use Illuminate\Support\Facades\Storage;

class BukupintarwhController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        return view('users.bukpinwh.index');
    }


    public function materi(Request $request)
    {
        $search = $request->input('search');
        $bukupintarwh = Bukupintarwh::where('title', 'LIKE', '%' . $search . '%')
            ->paginate(6);
        foreach ($bukupintarwh as $book) {
            $filePaths = is_array($book->file_paths) ? $book->file_paths : json_decode($book->file_paths, true);
            $book->thumbnail = $filePaths[0] ?? null;
        }

        return view('users.bukpinwh.materi', compact('bukupintarwh'));
    }


    public function materidetail($id)
    {
        $book = Bukupintarwh::find($id);
        if (!$book) {
            abort(404, 'Buku tidak ditemukan.');
        }
        $filePaths = is_array($book->file_paths) ? $book->file_paths : json_decode($book->file_paths, true);
        return view('users.bukpinwh.materidetail', compact('book', 'filePaths'));
    }

    public function video(Request $request)
    {
        $query = $request->input('search');
        $videos = Videobukupintarwh::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('users.bukpinwh.video', compact('videos'));
    }
}
