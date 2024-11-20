<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoIkt;
use Illuminate\Http\Request;

class VideoIktController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $videos = VideoIkt::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.ikt.video', compact('videos'));
    }

    public function create()
    {
        return view('admin.ikt.createvideo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
        ]);

        VideoIkt::create([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
        ]);

        return redirect()->route('admin.ikt.video')->with('success', 'Video added successfully');
    }

    public function edit($id)
    {
        $video = VideoIkt::findOrFail($id);
        return view('admin.ikt.editvideo', compact('video'));
    }


    public function update(Request $request, $id)
    {
        $video = VideoIkt::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
        ]);
        $video->title = $request->input('title');
        $video->video_link = $request->input('video_link');
        $video->save();

        return redirect()->route('admin.ikt.video')->with('success', 'Video updated successfully.');
    }


    public function destroy($id)
    {
        $video = VideoIkt::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.ikt.video')->with('success', 'Video deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            VideoIkt::whereIn('id', $ids)->delete();
            return redirect()->route('admin.ikt.video')->with('success', 'Selected videos deleted successfully.');
        } else {
            return redirect()->route('admin.ikt.video')->with('error', 'No videos selected for deletion.');
        }
    }
}
