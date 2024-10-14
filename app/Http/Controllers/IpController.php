<?php

namespace App\Http\Controllers;

use App\Models\Dokumenip;
use App\Models\VideoIp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IpController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();

        if ($user->class == 'IP') {
            $query = $request->input('search');
            $dokumens = Dokumenip::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%')
                    ->orWhere('title', 'like', '%' . $query . '%');
            })->paginate(10);

            return view('users.ip.index', compact('dokumens'));
        } else {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function materiDokumen(Request $request)
    {
        $user = Auth::user();

        if ($user->class == 'IP') {
            $query = $request->input('search');

            $dokumens = Dokumenip::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'asc')
                ->paginate(10);
            return view('users.ip.materi', compact('dokumens'));
        } else {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }


    public function video(Request $request)
    {
        $user = Auth::user();
        if ($user->class == 'IP') {
            $query = VideoIp::query();
            if ($request->has('search')) {
                $query->where('title', 'like', '%' . $request->input('search') . '%');
            }
            $videos = $query->orderBy('created_at', 'asc')->paginate(10);
            return view('users.ip.video', compact('videos'));
        } else {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
