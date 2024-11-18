<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Videocopkompra;

class VideoCopkompraController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $Videocopkompra = Videocopkompra::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.copkompra.video', compact('videocopkompra', 'search'));
    }

    public function create()
    {
        return view('admin.copkompra.createvideo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public/dokumen_images');

        Videocopkompra::create([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.Videocopkompra.video')->with('success', 'Video successfully added.');
    }

    public function edit($id)
    {
        $Videocopkompra = Videocopkompra::findOrFail($id);
        return view('admin.copkompra.editvideo', compact('Videocopkompra'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $Videocopkompra = Videocopkompra::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($Videocopkompra->image_path) {
                Storage::delete($Videocopkompra->image_path);
            }
            $imagePath = $request->file('image')->store('public/dokumen_images');
            $Videocopkompra->image_path = $imagePath;
        }

        $Videocopkompra->update([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $Videocopkompra->image_path,
        ]);

        return redirect()->route('admin.Videocopkompra.video')->with('success', 'Video successfully updated.');
    }

    public function destroy($id)
    {
        $video = Videocopkompra::find($id);

        if (!$video) {
            return redirect()->route('admin.Videocopkompra.video')
                ->with('error', 'Video tidak ditemukan!');
        }
        if ($video->image_path && Storage::exists($video->image_path)) {
            Storage::delete($video->image_path);
        }
        $video->delete();

        return redirect()->route('admin.Videocopkompra.video')
            ->with('success', 'Video berhasil dihapus!');
    }


    public function bulkDelete(Request $request)
    {
        $videoIds = $request->input('video_ids');

        if ($videoIds) {
            Videocopkompra::whereIn('id', $videoIds)->delete();
            return redirect()->route('admin.Videocopkompra.video')->with('success', 'Selected videos deleted successfully.');
        }

        return redirect()->route('admin.Videocopkompra.video')->with('error', 'No videos selected for deletion.');
    }
}
