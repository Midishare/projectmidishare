<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Copdevprog;
use App\Models\Videocopdevprog;

class CopdevprogController extends Controller
{

    public function index(Request $request)
    {
        try {
            $query = $request->input('search');

            $dokumens = Copdevprog::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.copdevprog.index', compact('dokumens'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function materiDokumen(Request $request)
    {
        $query = $request->input('search');

        $dokumens = Copdevprog::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.copdevprog.materi', compact('dokumens'));
    }

    public function video(Request $request)
    {

        try {

            $query = $request->input('search');
            $videos = Videocopdevprog::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('users.copdevprog.video', compact('videos'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
