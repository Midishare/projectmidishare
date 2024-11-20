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
            $category = $request->input('category');
            $categories = [
                'Human Capital',
                'Business Controlling',
                'Corporate Audit',
                'Finance',
                'IT',
                'Merchandising',
                'Marketing',
                'Operation',
                'Property Development',
                'Service Quality',
                'Corporate Legal & Compliance'
            ];
            $dokumens = Dokumenip::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->when($category, function ($queryBuilder) use ($category) {
                    return $queryBuilder->where('category', $category);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.ip.materi', compact('dokumens', 'categories'));
        } else {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }


    public function video(Request $request)
    {
        $user = Auth::user();
        if ($user->class == 'IP') {
            $query = $request->input('search');
            $category = $request->input('category');
            $categories = [
                'Business Controlling',
                'Corporate Audit',
                'Finance',
                'IT',
                'Merchandising',
                'Marketing',
                'Operation',
                'Property Development',
                'Service Quality',
                'Corporate Legal & Compliance'
            ];
            $videos = VideoIp::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->when($category, function ($queryBuilder) use ($category) {
                    return $queryBuilder->where('category', $category);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('users.ip.video', compact('videos', 'categories'));
        } else {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
