<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoMvp;
use Illuminate\Http\Request;

class VideoMvpController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $videos = VideoMvp::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.mvp.video', compact('videos'));
    }

    public function create()
    {
        return view('admin.mvp.createvideo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
        ]);
        VideoMvp::create([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
        ]);

        return redirect()->route('admin.mvp.video')->with('success', 'Video added successfully');
    }

    public function edit($id)
    {
        $video = VideoMvp::findOrFail($id);
        return view('admin.mvp.editvideo', compact('video'));
    }


    public function update(Request $request, $id)
    {
        $video = VideoMvp::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
        ]);

        $video->title = $request->input('title');
        $video->video_link = $request->input('video_link');
        $video->save();

        return redirect()->route('admin.mvp.video')->with('success', 'Video updated successfully.');
    }


    public function destroy($id)
    {
        $video = VideoMvp::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.mvp.video')->with('success', 'Video deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            VideoMvp::whereIn('id', $ids)->delete();
            return redirect()->route('admin.mvp.video')->with('success', 'Selected videos deleted successfully.');
        } else {
            return redirect()->route('admin.mvp.video')->with('error', 'No videos selected for deletion.');
        }
    }
}
