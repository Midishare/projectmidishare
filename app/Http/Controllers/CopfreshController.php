<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Copfresh;
use App\Models\Videocopfresh;

class CopfreshController extends Controller
{
    public function allcopuser()
    {
        return view('copusers');
    }

    public function index(Request $request)
    {
        try {
            $query = $request->input('search');

            $dokumens = Copfresh::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.copfresh.index', compact('dokumens'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function materiDokumen(Request $request)
    {
        $query = $request->input('search');

        $dokumens = Copfresh::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.copfresh.materi', compact('dokumens'));
    }

    public function video(Request $request)
    {

        try {

            $query = $request->input('search');
            $videos = Videocopfresh::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('users.copfresh.video', compact('videos'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
