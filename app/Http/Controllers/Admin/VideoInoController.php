<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoIno; // Updated to reference VideoIp
use Illuminate\Http\Request;

class VideoInoController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $videos = VideoIno::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.ino.video', compact('videos')); // Updated view path to match Videoino
    }

    public function create()
    {
        return view('admin.ino.createvideo'); // Updated view path to match Videoino
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url', // Consistent with Videoino
        ]);

        // Store the video in the database
        VideoIno::create([ // Changed to use Videoino
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'), // Updated field name
        ]);

        // Redirect to the video list with a success message
        return redirect()->route('admin.video')->with('success', 'Video added successfully');
    }

    public function edit($id)
    {
        $video = VideoIno::findOrFail($id); // Ambil data video berdasarkan ID
        return view('admin.ino.editvideo', compact('video')); // Kirim data ke view
    }


    public function update(Request $request, $id)
    {
        $video = VideoIno::findOrFail($id);

        // Validasi dan pembaruan
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
        ]);

        // Update video
        $video->title = $request->input('title');
        $video->video_link = $request->input('video_link');
        $video->save();

        return redirect()->route('admin.video')->with('success', 'Video updated successfully.');
    }


    public function destroy($id)
    {
        $video = VideoIno::findOrFail($id); // Changed to use Videoino
        $video->delete();

        return redirect()->route('admin.video')->with('success', 'Video deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            VideoIno::whereIn('id', $ids)->delete();
            return redirect()->route('admin.video')->with('success', 'Selected videos deleted successfully.');
        } else {
            return redirect()->route('admin.video')->with('error', 'No videos selected for deletion.');
        }
    }
}
