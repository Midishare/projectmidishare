<?php

namespace App\Http\Controllers;

use App\Models\Dokumenip;
use App\Models\VideoIp;
use Illuminate\Http\Request;

class IpController extends Controller
{
    public function index(Request $request)
    {
        // Fetch search query from the request
        $query = $request->input('search');

        // Fetch documents with pagination and search
        $dokumens = Dokumenip::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%') // Ensure column names are correct
                ->orWhere('title', 'like', '%' . $query . '%'); // Adjust column names as necessary
        })->paginate(10); // Adjust pagination as needed

        return view('users.ip.index', compact('dokumens')); // Use 'dokumens' for consistency
    }

    public function materiDokumen(Request $request)
    {
        // Fetch search query from the request
        $query = $request->input('search');

        // Fetch documents with pagination and search
        $dokumens = Dokumenip::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%') // Ensure column names are correct
                ->orWhere('title', 'like', '%' . $query . '%'); // Adjust column names as necessary
        })->paginate(10); // Adjust pagination as needed

        // Return the view for Materi Dokumen with the documents
        return view('users.ip.materi', compact('dokumens')); // Use 'dokumens' for consistency
    }

    public function video(Request $request)
    {

        // Ambil semua video dari database
        $query = VideoIp::query();

        // Jika ada query pencarian
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $videos = $query->paginate(10); // Menampilkan 10 video per halaman
        return view('users.ip.video', compact('videos'));
        // Return the view for Video
    }
}
