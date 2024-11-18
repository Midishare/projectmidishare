<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Videocoptrahou;

class VideoCoptrahouController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $videocoptrahou = Videocoptrahou::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.coptrahou.video', compact('videocoptrahou', 'search'));
    }

    public function create()
    {
        return view('admin.coptrahou.createvideo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public/dokumen_images');

        Videocoptrahou::create([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.videocoptrahou.video')->with('success', 'Video successfully added.');
    }

    public function edit($id)
    {
        $videocoptrahou = Videocoptrahou::findOrFail($id);
        return view('admin.coptrahou.editvideo', compact('videocoptrahou'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $videocoptrahou = Videocoptrahou::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($videocoptrahou->image_path) {
                Storage::delete($videocoptrahou->image_path);
            }
            $imagePath = $request->file('image')->store('public/dokumen_images');
            $videocoptrahou->image_path = $imagePath;
        }

        $videocoptrahou->update([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $videocoptrahou->image_path,
        ]);

        return redirect()->route('admin.videocoptrahou.video')->with('success', 'Video successfully updated.');
    }

    public function destroy($id)
    {
        $video = Videocoptrahou::find($id);

        if (!$video) {
            return redirect()->route('admin.videocoptrahou.video')
                ->with('error', 'Video tidak ditemukan!');
        }
        if ($video->image_path && Storage::exists($video->image_path)) {
            Storage::delete($video->image_path);
        }
        $video->delete();

        return redirect()->route('admin.videocoptrahou.video')
            ->with('success', 'Video berhasil dihapus!');
    }


    public function bulkDelete(Request $request)
    {
        $videoIds = $request->input('video_ids');

        if ($videoIds) {
            Videocoptrahou::whereIn('id', $videoIds)->delete();
            return redirect()->route('admin.videocoptrahou.video')->with('success', 'Selected videos deleted successfully.');
        }

        return redirect()->route('admin.videocoptrahou.video')->with('error', 'No videos selected for deletion.');
    }
}
