<?php

namespace App\Http\Controllers;

use App\Models\Dokumenino;
use App\Models\VideoIno;
use Illuminate\Http\Request;

class InoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = $request->input('search');

            $dokumens = Dokumenino::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('users.ino.index', compact('dokumens'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }

    public function materiDokumen(Request $request)
    {
        $query = $request->input('search');
        $category = $request->input('category');
        $categories = [
            'Ambon',
            'Bekasi',
            'Bitung',
            'Boyolali',
            'Head Office',
            'Kendari',
            'Makasar',
            'Manado',
            'Medan',
            'Palu',
            'Pasuruan',
            'Samarinda'
        ];

        $dokumens = Dokumenino::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })
            ->when($category, function ($queryBuilder) use ($category) {
                return $queryBuilder->where('category', $category);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('users.ino.materi', compact('dokumens', 'categories'));
    }

    public function video(Request $request)
    {

        try {

            $query = $request->input('search');
            $category = $request->input('category');
            $categories = [
                'Ambon',
                'Bekasi',
                'Bitung',
                'Boyolali',
                'Head Office',
                'Kendari',
                'Makasar',
                'Manado',
                'Medan',
                'Palu',
                'Pasuruan',
                'Samarinda',
            ];

            $videos = VideoIno::when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('title', 'like', '%' . $query . '%');
            })
                ->when($category, function ($queryBuilder) use ($category) {
                    return $queryBuilder->where('category', $category);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);


            return view('users.ino.video', compact('videos', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }
}
