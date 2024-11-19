<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Coptrahou;
use App\Models\Videocoptrahou;

class CoptrahouController extends Controller
{

    public function index(Request $request)
    {
        try {
            $query = $request->input('search');

            $dokumens = Coptrahou::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.coptrahou.index', compact('dokumens'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function materiDokumen(Request $request)
    {
        $query = $request->input('search');

        $dokumens = Coptrahou::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.coptrahou.materi', compact('dokumens'));
    }

    public function video(Request $request)
    {

        try {

            $query = $request->input('search');
            $videos = Videocoptrahou::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('users.coptrahou.video', compact('videos'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
