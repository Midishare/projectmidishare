<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Copkompra;
use App\Models\Videocopkompra;

class CopkompraController extends Controller
{

    public function index(Request $request)
    {
        try {
            $query = $request->input('search');

            $dokumens = Copkompra::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.copkompra.index', compact('dokumens'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function materiDokumen(Request $request)
    {
        $query = $request->input('search');

        $dokumens = Copkompra::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.copkompra.materi', compact('dokumens'));
    }

    public function video(Request $request)
    {

        try {

            $query = $request->input('search');
            $videos = Videocopkompra::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('users.copkompra.video', compact('videos'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
