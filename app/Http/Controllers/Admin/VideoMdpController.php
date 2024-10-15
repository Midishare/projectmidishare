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
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'category' => 'required|in:Business Controlling,Corporate Audit,Finance,IT,Merchandising,Marketing,Operation,Property Development,Service Quality,Corporate Legal & Compliance',
        ]);

        VideoMdp::create([
            'title' => $request->input('title'),
            'link' => $request->input('link'),
            'category' => $request->input('category'),
        ]);

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

        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'category' => 'required|in:Business Controlling,Corporate Audit,Finance,IT,Merchandising,Marketing,Operation,Property Development,Service Quality,Corporate Legal & Compliance',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $video->title = $request->input('title');
        $video->link = $request->input('link');
        $video->category = $request->input('category');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('videos', 'public');
            $video->image = $imagePath;
        }

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
