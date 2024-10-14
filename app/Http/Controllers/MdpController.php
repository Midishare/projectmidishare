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

            $dokumens = Dokumenmdp::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%')
                    ->orWhere('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.mdp.materi', compact('dokumens'));
        } else {

            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function video(Request $request)
    {
        $user = Auth::user();

        if ($user->class == 'MDP') {
            $query = VideoMdp::query();

            if ($request->has('search')) {
                $query->where('title', 'like', '%' . $request->input('search') . '%');
            }

            $videos = $query->orderBy('created_at', 'desc')->paginate(10);
            return view('users.mdp.video', compact('videos'));
        } else {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
