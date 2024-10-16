<?php

namespace App\Http\Controllers;

use App\Models\Dokumenmdp;
use App\Models\VideoMdp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MdpController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->class == 'MDP') {
            $query = $request->input('search');
            $dokumens = Dokumenmdp::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%')
                    ->orWhere('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.mdp.index', compact('dokumens'));
        } else {

            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function materiDokumen(Request $request)
    {
        $user = Auth::user();

        if ($user->class == 'MDP') {
            $query = $request->input('search');
            $category = $request->input('category');
            $categories = [
                'Human Capital',
                'Business Controlling',
                'Corporate Audit',
                'Finance',
                'IT',
                'Merchandising',
                'Marketing',
                'Operation',
                'Property Development',
                'Service Quality',
                'Corporate Legal & Compliance'
            ];
            $dokumens = Dokumenmdp::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->when($category, function ($queryBuilder) use ($category) {
                    return $queryBuilder->where('category', $category); // Filter berdasarkan kategori
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            // Kirim variabel dokumens dan categories ke view
            return view('users.mdp.materi', compact('dokumens', 'categories'));
        } else {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function video(Request $request)
    {
        $user = Auth::user();

        if ($user->class == 'MDP') {
            $query = $request->input('search');
            $category = $request->input('category');
            $categories = [
                'Human Capital',
                'Business Controlling',
                'Corporate Audit',
                'Finance',
                'IT',
                'Merchandising',
                'Marketing',
                'Operation',
                'Property Development',
                'Service Quality',
                'Corporate Legal & Compliance'
            ];
            $videos = VideoMdp::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->when($category, function ($queryBuilder) use ($category) {
                    return $queryBuilder->where('category', $category);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('users.mdp.video', compact('videos', 'categories'));
        } else {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
