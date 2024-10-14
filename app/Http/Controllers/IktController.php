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
        try {
            $query = $request->input('search');

            $dokumens = Dokumenikt::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.ikt.index', compact('dokumens'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function materiDokumen(Request $request)
    {
        $query = $request->input('search');

        $dokumens = Dokumenikt::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.ikt.materi', compact('dokumens'));
    }

    public function video(Request $request)
    {

        try {
            $query = VideoIkt::query();

            if ($request->has('search')) {
                $query->where('title', 'like', '%' . $request->input('search') . '%');
            }

            $videos = $query->orderBy('created_at', 'desc')->paginate(10);

            return view('users.ikt.video', compact('videos'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
