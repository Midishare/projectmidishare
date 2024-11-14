<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Videocopfresh;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VideoCopfreshController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $videocopfresh = Videocopfresh::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.copfresh.video', compact('videocopfresh', 'search'));
    }

    public function create()
    {
        return view('admin.copfresh.createvideo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('public/dokumen_images');

        Videocopfresh::create([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.videocopfresh.video')->with('success', 'Video successfully added.');
    }

    public function edit($id)
    {
        $videocopfresh = Videocopfresh::findOrFail($id);
        return view('admin.copfresh.editvideo', compact('videocopfresh'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $videocopfresh = Videocopfresh::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($videocopfresh->image_path) {
                Storage::delete($videocopfresh->image_path);
            }
            $imagePath = $request->file('image')->store('public/dokumen_images');
            $videocopfresh->image_path = $imagePath;
        }

        $videocopfresh->update([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'image_path' => $videocopfresh->image_path,
        ]);

        return redirect()->route('admin.videocopfresh.video')->with('success', 'Video successfully updated.');
    }

    public function destroy($id)
    {
        $videocopfresh = Videocopfresh::findOrFail($id);

        if ($videocopfresh->image_path) {
            Storage::delete($videocopfresh->image_path);
        }

        $videocopfresh->delete();

        return redirect()->route('admin.videocopfresh.video')->with('success', 'Video successfully deleted.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids) {
            Videocopfresh::whereIn('id', $ids)->delete();
            return redirect()->route('admin.videocopfresh.video')->with('success', 'Selected videos have been deleted successfully.');
        }
        return redirect()->route('admin.videocopfresh.video')->with('error', 'No videos selected for deletion.');
    }
}
