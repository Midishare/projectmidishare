<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoIp; // Updated to reference VideoIp
use Illuminate\Http\Request;

class VideoIpController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $videos = VideoIp::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.ip.video', compact('videos')); // Updated view path to match VideoIp
    }

    public function create()
    {
        return view('admin.ip.createvideo'); // Updated view path to match VideoIp
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url', // Consistent with VideoIp
        ]);

        // Store the video in the database
        VideoIp::create([ // Changed to use VideoIp
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'), // Updated field name
        ]);

        // Redirect to the video list with a success message
        return redirect()->route('admin.video')->with('success', 'Video added successfully');
    }

    public function edit($id)
    {
        $video = VideoIp::findOrFail($id); // Ambil data video berdasarkan ID
        return view('admin.ip.editvideo', compact('video')); // Kirim data ke view
    }


    public function update(Request $request, $id)
    {
        $video = VideoIp::findOrFail($id);

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
        $video = VideoIp::findOrFail($id); // Changed to use VideoIp
        $video->delete();

        return redirect()->route('admin.video')->with('success', 'Video deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            VideoIp::whereIn('id', $ids)->delete(); // Changed to use VideoIp
            return redirect()->route('admin.video')->with('success', 'Selected videos deleted successfully.');
        } else {
            return redirect()->route('admin.video')->with('error', 'No videos selected for deletion.');
        }
    }
}
