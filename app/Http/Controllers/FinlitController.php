<?php

namespace App\Http\Controllers;

use App\Models\Dokumenfinlit;
use App\Models\VideoFinlit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FinlitController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->class == 'FL') {
            $query = $request->input('search');

            $dokumens = Dokumenfinlit::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })->paginate(10);

            return view('users.finlit.index', compact('dokumens'));
        }

        return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
    }

    public function materiDokumen(Request $request)
{
    $search = $request->input('search');
    $documents = Dokumenfinlit::when($search, function ($query, $search) {
        return $query->where('title', 'like', "%{$search}%");
    })->orderBy('created_at', 'desc') 
      ->paginate(10); 

    return view('admin.finlit.materi', compact('documents', 'search'));
}


public function video(Request $request)
{
    $user = Auth::user();

    if ($user->class == 'FL') {
        $query = VideoFinlit::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        $videos = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('users.finlit.video', compact('videos'));
    }

    return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
}

}
