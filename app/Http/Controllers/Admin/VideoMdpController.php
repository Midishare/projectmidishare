<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoMdp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VideoMdpController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $videos = VideoMdp::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.mdp.video', compact('videos'));
    }

    public function create()
    {
        return view('admin.mdp.createvideo');
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
        ]);

        // Store the video in the database
        VideoMdp::create([
            'title' => $request->input('title'),
            'link' => $request->input('link'),
        ]);

        // Redirect to the video list with a success message
        return redirect()->route('admin.mdp.video')->with('success', 'Video added successfully');
    }

    public function edit($id)
    {
        $video = VideoMdp::findOrFail($id);
        return view('admin.mdp.editvideo', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = VideoMdp::findOrFail($id);

        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update title and link
        $video->title = $request->input('title');
        $video->link = $request->input('link');

        // Handle image update if uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('videos', 'public');
            $video->image = $imagePath;
        }

        // Save the updated video
        $video->save();

        return redirect()->route('admin.mdp.video')->with('success', 'Video updated successfully');
    }


    public function destroy($id)
    {
        $video = VideoMdp::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.mdp.video')->with('success', 'Video deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            VideoMdp::whereIn('id', $ids)->delete();
            return redirect()->route('admin.mdp.video')->with('success', 'Selected videos deleted successfully.');
        } else {
            return redirect()->route('admin.mdp.video')->with('error', 'No videos selected for deletion.');
        }
    }
}
