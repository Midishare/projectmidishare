<?php

namespace App\Http\Controllers;

use App\Models\Dokumenmvp;
use App\Models\VideoMvp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MvpController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = $request->input('search');
            $dokumens = Dokumenmvp::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.mvp.index', compact('dokumens'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function materiDokumen(Request $request)
    {
        $query = $request->input('search');

        $dokumens = Dokumenmvp::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.mvp.materi', compact('dokumens'));
    }

    public function video(Request $request)
    {
        try {
            $query = $request->input('search');

            $videos = VideoMvp::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.mvp.video', compact('videos'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
