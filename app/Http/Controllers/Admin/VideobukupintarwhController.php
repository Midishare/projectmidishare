<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Videobukupintarwh;

class VideobukupintarwhController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $videobukupintarwh = Videobukupintarwh::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.bukupintarwh.video', compact('videobukupintarwh', 'search'));
    }

    public function create()
    {
        return view('admin.bukupintarwh.createvideo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = 'public/dokumen_images';
            $file->storeAs($destinationPath, $filename);
            $imagePath = $destinationPath . '/' . $filename;
        } else {
            $imagePath = null;
        }

        Videobukupintarwh::create([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.videobukupintarwh.video')->with('success', 'Video successfully added.');
    }

    public function edit($id)
    {
        $videobukupintarwh = Videobukupintarwh::findOrFail($id);
        return view('admin.bukupintarwh.editvideo', compact('videobukupintarwh'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $videobukupintarwh = Videobukupintarwh::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($videobukupintarwh->image_path) {
                Storage::delete($videobukupintarwh->image_path);
            }
            $imagePath = $request->file('image')->store('public/dokumen_images');
            $videobukupintarwh->image_path = $imagePath;
        }

        $videobukupintarwh->update([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $videobukupintarwh->image_path,
        ]);

        return redirect()->route('admin.videobukupintarwh.video')->with('success', 'Video successfully updated.');
    }

    public function destroy($id)
    {
        $video = Videobukupintarwh::find($id);

        if (!$video) {
            return redirect()->route('admin.videobukupintarwh.video')
                ->with('error', 'Video tidak ditemukan!');
        }
        if ($video->image_path && Storage::exists($video->image_path)) {
            Storage::delete($video->image_path);
        }
        $video->delete();

        return redirect()->route('admin.videobukupintarwh.video')
            ->with('success', 'Video berhasil dihapus!');
    }


    public function bulkDelete(Request $request)
    {
        $videoIds = $request->input('video_ids');

        if ($videoIds) {
            Videobukupintarwh::whereIn('id', $videoIds)->delete();
            return redirect()->route('admin.videobukupintarwh.video')->with('success', 'Selected videos deleted successfully.');
        }

        return redirect()->route('admin.videobukupintarwh.video')->with('error', 'No videos selected for deletion.');
    }
}
