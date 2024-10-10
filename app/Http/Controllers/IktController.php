<?php

namespace App\Http\Controllers;

use App\Models\Dokumenikt;
use App\Models\VideoIkt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IktController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->class == 'FL') {
            $query = $request->input('search');

            // Fetch documents with pagination and search
            $dokumens = Dokumenikt::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%') // Ensure column names are correct
                    ->orWhere('title', 'like', '%' . $query . '%'); // Adjust column names as necessary
            })->paginate(10); // Adjust pagination as needed

            return view('users.ikt.index', compact('dokumens')); // Use 'dokumens' for consistency
        }
        return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        // Fetch search query from the request

    }

    public function materiDokumen(Request $request)
    {
        // Fetch search query from the request
        $query = $request->input('search');

        // Fetch documents with pagination and search
        $dokumens = Dokumenikt::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%') // Ensure column names are correct
                ->orWhere('title', 'like', '%' . $query . '%'); // Adjust column names as necessary
        })->paginate(10); // Adjust pagination as needed

        // Return the view for Materi Dokumen with the documents
        return view('users.ikt.materi', compact('dokumens')); // Use 'dokumens' for consistency
    }

    public function video(Request $request)
    {
        $user = Auth::user();

        if ($user->class == 'FL') {
            // Ambil semua video dari database
            $query = VideoIkt::query();

            // Jika ada query pencarian
            if ($request->has('search')) {
                $query->where('title', 'like', '%' . $request->input('search') . '%');
            }

            $videos = $query->paginate(10); // Menampilkan 10 video per halaman
            return view('users.ikt.video', compact('videos'));
            // Return the view for Video
        }
        return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
    }
}
