<?php

namespace App\Http\Controllers;

use App\Models\Dokumenwebin;
use App\Models\VideoWebin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WebinController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = $request->input('search');
            $dokumens = Dokumenwebin::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.webinar.index', compact('dokumens'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function materiDokumen(Request $request)
    {
        $query = $request->input('search');

        $dokumens = Dokumenwebin::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.webinar.materi', compact('dokumens'));
    }

    public function video(Request $request)
    {
        try {
            $query = $request->input('search');

            $videos = VideoWebin::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.webinar.video', compact('videos'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
