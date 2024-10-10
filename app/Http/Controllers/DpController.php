<?php

namespace App\Http\Controllers;

use App\Models\Dokumendp;
use App\Models\VideoDp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DpController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->class == 'MOD') {
            $query = $request->input('search');
            $dokumens = Dokumendp::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%')
                    ->orWhere('title', 'like', '%' . $query . '%');
            })->orderBy('created_at', 'desc')->paginate(10);
            return view('users.dp.index', compact('dokumens'));
        }
        return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
    }

    public function materiDokumen(Request $request)
    {
        $query = $request->input('search');
        $dokumens = Dokumendp::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%')
                ->orWhere('title', 'like', '%' . $query . '%');
        })->orderBy('created_at', 'desc')->paginate(10);
        return view('users.dp.materi', compact('dokumens'));
    }

    public function video(Request $request)
    {
        $user = Auth::user();
        if ($user->class == 'MOD') {
            $query = VideoDp::query();
            if ($request->has('search')) {
                $query->where('title', 'like', '%' . $request->input('search') . '%');
            }
            $videos = $query->orderBy('created_at', 'desc')->paginate(10);
            return view('users.dp.video', compact('videos'));
        }
        return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
    }
}
