<?php

namespace App\Http\Controllers;

use App\Models\Dokumenfinlit;
use App\Models\VideoFinlit;
use Illuminate\Http\Request;

class FinlitController extends Controller
{
    public function index(Request $request)
    {
        // Fetch search query from the request
        $query = $request->input('search');

        // Fetch documents with pagination and search
        $dokumens = Dokumenfinlit::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%') // Ensure column names are correct
                ->orWhere('title', 'like', '%' . $query . '%'); // Adjust column names as necessary
        })->paginate(10); // Adjust pagination as needed

        return view('users.finlit.index', compact('dokumens')); // Use 'dokumens' for consistency
    }

    public function materiDokumen(Request $request)
    {
        // Fetch search query from the request
        $query = $request->input('search');

        // Fetch documents with pagination and search
        $dokumens = Dokumenfinlit::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%') // Ensure column names are correct
                ->orWhere('title', 'like', '%' . $query . '%'); // Adjust column names as necessary
        })->paginate(10); // Adjust pagination as needed

        // Return the view for Materi Dokumen with the documents
        return view('users.finlit.materi', compact('dokumens')); // Use 'dokumens' for consistency
    }

    public function video(Request $request)
    {

        // Ambil semua video dari database
        $query = VideoFinlit::query();

        // Jika ada query pencarian
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $videos = $query->paginate(10); // Menampilkan 10 video per halaman
        return view('users.finlit.video', compact('videos'));
        // Return the view for Video
    }
}
