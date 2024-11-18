<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Videocopinofest;

class VideocopinofestController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $videocopinofest = Videocopinofest::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.copinofest.video', compact('videocopinofest', 'search'));
    }

    public function create()
    {
        return view('admin.copinofest.createvideo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public/dokumen_images');

        Videocopinofest::create([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.videocopinofest.video')->with('success', 'Video successfully added.');
    }

    public function edit($id)
    {
        $videocopinofest = Videocopinofest::findOrFail($id);
        return view('admin.copinofest.editvideo', compact('videocopinofest'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $videocopinofest = Videocopinofest::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($videocopinofest->image_path) {
                Storage::delete($videocopinofest->image_path);
            }
            $imagePath = $request->file('image')->store('public/dokumen_images');
            $videocopinofest->image_path = $imagePath;
        }

        $videocopinofest->update([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $videocopinofest->image_path,
        ]);

        return redirect()->route('admin.videocopinofest.video')->with('success', 'Video successfully updated.');
    }

    public function destroy($id)
    {
        $video = VideoCopInoFest::find($id);

        if (!$video) {
            return redirect()->route('admin.videocopinofest.video')
                ->with('error', 'Video tidak ditemukan!');
        }
        if ($video->image_path && Storage::exists($video->image_path)) {
            Storage::delete($video->image_path);
        }
        $video->delete();

        return redirect()->route('admin.videocopinofest.video')
            ->with('success', 'Video berhasil dihapus!');
    }


    public function bulkDelete(Request $request)
    {
        $videoIds = $request->input('video_ids');

        if ($videoIds) {
            VideoCopInoFest::whereIn('id', $videoIds)->delete();
            return redirect()->route('admin.videocopinofest.video')->with('success', 'Selected videos deleted successfully.');
        }

        return redirect()->route('admin.videocopinofest.video')->with('error', 'No videos selected for deletion.');
    }
}
