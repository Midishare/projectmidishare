<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoIp;
use Illuminate\Http\Request;

class VideoIpController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $videos = VideoIp::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.ip.video', compact('videos'));
    }

    public function create()
    {
        return view('admin.ip.createvideo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'category' => 'required|in:Business Controlling,Corporate Audit,Finance,IT,Merchandising,Marketing,Operation,Property Development,Service Quality,Corporate Legal & Compliance',
        ]);
        VideoIp::create([
            'title' => $request->input('title'),
            'video_link' => $request->input('video_link'),
            'category' => $request->input('category'),
        ]);

        return redirect()->route('admin.ip.video')->with('success', 'Video added successfully');
    }

    public function edit($id)
    {
        $video = VideoIp::findOrFail($id);
        return view('admin.ip.editvideo', compact('video'));
    }


    public function update(Request $request, $id)
    {
        $video = VideoIp::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'video_link' => 'required|url',
            'category' => 'required|in:Business Controlling,Corporate Audit,Finance,IT,Merchandising,Marketing,Operation,Property Development,Service Quality,Corporate Legal & Compliance',
        ]);

        $video->title = $request->input('title');
        $video->video_link = $request->input('video_link');
        $video->category = $request->input('category');
        $video->save();

        return redirect()->route('admin.ip.video')->with('success', 'Video updated successfully.');
    }


    public function destroy($id)
    {
        $video = VideoIp::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.ip.video')->with('success', 'Video deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            VideoIp::whereIn('id', $ids)->delete();
            return redirect()->route('admin.ip.video')->with('success', 'Selected videos deleted successfully.');
        } else {
            return redirect()->route('admin.ip.video')->with('error', 'No videos selected for deletion.');
        }
    }
}
