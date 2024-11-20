<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoFinlit;
use Illuminate\Http\Request;

class VideoFinlitController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $videos = VideoFinlit::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.finlit.video', compact('videos'));
    }

    public function create()
    {
        return view('admin.finlit.createvideo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
        ]);

        VideoFinlit::create([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
        ]);
        return redirect()->route('admin.finlit.video')->with('success', 'Video added successfully');
    }

    public function edit($id)
    {
        $video = VideoFinlit::findOrFail($id);
        return view('admin.finlit.editvideo', compact('video'));
    }


    public function update(Request $request, $id)
    {
        $video = VideoFinlit::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
        ]);
        $video->title = $request->input('title');
        $video->video_link = $request->input('video_link');
        $video->save();

        return redirect()->route('admin.finlit.video')->with('success', 'Video updated successfully.');
    }


    public function destroy($id)
    {
        $video = VideoFinlit::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.finlit.video')->with('success', 'Video deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            VideoFinlit::whereIn('id', $ids)->delete();
            return redirect()->route('admin.finlit.video')->with('success', 'Selected videos deleted successfully.');
        } else {
            return redirect()->route('admin.finlit.video')->with('error', 'No videos selected for deletion.');
        }
    }
}
