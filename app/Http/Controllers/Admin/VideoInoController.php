<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoIno;
use Illuminate\Http\Request;

class VideoInoController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $videos = VideoIno::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.ino.video', compact('videos'));
    }

    public function create()
    {
        return view('admin.ino.createvideo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'category' => 'required|in:Ambon,Bekasi,Bitung,Boyolali,Head Office,Kendari,Makasar,Manado,Medan,Palu,Pasuruan,Samarinda',
        ]);

        VideoIno::create([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'category' => $request->input('category'),
        ]);
        return redirect()->route('admin.ino.video')->with('success', 'Video added successfully');
    }

    public function edit($id)
    {
        $video = VideoIno::findOrFail($id);
        return view('admin.ino.editvideo', compact('video'));
    }


    public function update(Request $request, $id)
    {
        $video = VideoIno::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'category' => 'required|in:Ambon,Bekasi,Bitung,Boyolali,Head Office,Kendari,Makasar,Manado,Medan,Palu,Pasuruan,Samarinda',
        ]);

        $video->title = $request->input('title');
        $video->video_link = $request->input('video_link');
        $video->category = $request->input('category');
        $video->save();

        return redirect()->route('admin.ino.video')->with('success', 'Video updated successfully.');
    }


    public function destroy($id)
    {
        $video = VideoIno::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.ino.video')->with('success', 'Video deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            VideoIno::whereIn('id', $ids)->delete();
            return redirect()->route('admin.ino.video')->with('success', 'Selected videos deleted successfully.');
        } else {
            return redirect()->route('admin.ino.video')->with('error', 'No videos selected for deletion.');
        }
    }
}
