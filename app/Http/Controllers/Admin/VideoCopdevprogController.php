<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Videocopdevprog;

class VideoCopdevprogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $videocopdevprog = Videocopdevprog::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.copdevprog.video', compact('videocopdevprog', 'search'));
    }

    public function create()
    {
        return view('admin.copdevprog.createvideo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public/dokumen_images');

        Videocopdevprog::create([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.videocopdevprog.video')->with('success', 'Video successfully added.');
    }

    public function edit($id)
    {
        $videocopdevprog = Videocopdevprog::findOrFail($id);
        return view('admin.copdevprog.editvideo', compact('videocopdevprog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $videocopdevprog = Videocopdevprog::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($videocopdevprog->image_path) {
                Storage::delete($videocopdevprog->image_path);
            }
            $imagePath = $request->file('image')->store('public/dokumen_images');
            $videocopdevprog->image_path = $imagePath;
        }

        $videocopdevprog->update([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $videocopdevprog->image_path,
        ]);

        return redirect()->route('admin.videocopdevprog.video')->with('success', 'Video successfully updated.');
    }

    public function destroy($id)
    {
        $video = Videocopdevprog::find($id);

        if (!$video) {
            return redirect()->route('admin.videocopdevprog.video')
                ->with('error', 'Video tidak ditemukan!');
        }
        if ($video->image_path && Storage::exists($video->image_path)) {
            Storage::delete($video->image_path);
        }
        $video->delete();

        return redirect()->route('admin.videocopdevprog.video')
            ->with('success', 'Video berhasil dihapus!');
    }


    public function bulkDelete(Request $request)
    {
        $videoIds = $request->input('video_ids');

        if ($videoIds) {
            Videocopdevprog::whereIn('id', $videoIds)->delete();
            return redirect()->route('admin.videocopdevprog.video')->with('success', 'Selected videos deleted successfully.');
        }

        return redirect()->route('admin.videocopdevprog.video')->with('error', 'No videos selected for deletion.');
    }
}
