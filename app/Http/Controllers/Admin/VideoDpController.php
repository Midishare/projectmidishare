<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoDp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class VideoDpController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $videos = VideoDp::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('title', 'like', '%' . $query . '%');
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.dp.video', compact('videos'));
    }

    public function create()
    {
        return view('admin.dp.createvideo');
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'category' => 'required|in:Business Controlling,Corporate Audit,Finance,IT,Merchandising,Marketing,Operation,Property Development,Service Quality,Corporate Legal & Compliance',
        ]);

        // Store the video in the database
        VideoDp::create([
            'title' => $request->input('title'),
            'link' => $request->input('link'),
            'category' => $request->input('category'),
        ]);

        // Redirect to the video list with a success message
        return redirect()->route('admin.dp.video')->with('success', 'Video added successfully');
    }

    public function edit($id)
    {
        $video = VideoDp::findOrFail($id);
        return view('admin.dp.editvideo', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = VideoDp::findOrFail($id);

        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'category' => 'required|in:Business Controlling,Corporate Audit,Finance,IT,Merchandising,Marketing,Operation,Property Development,Service Quality,Corporate Legal & Compliance',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update title and link
        $video->title = $request->input('title');
        $video->link = $request->input('link');
        $video->category = $request->input('category');

        // Handle image update if uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('videos', 'public');
            $video->image = $imagePath;
        }

        // Save the updated video
        $video->save();

        return redirect()->route('admin.dp.video')->with('success', 'Video updated successfully');
    }


    public function destroy($id)
    {
        $video = VideoDp::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.dp.video')->with('success', 'Video deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!empty($ids)) {
            VideoDp::whereIn('id', $ids)->delete();
            return redirect()->route('admin.dp.video')->with('success', 'Selected videos deleted successfully.');
        } else {
            return redirect()->route('admin.dp.video')->with('error', 'No videos selected for deletion.');
        }
    }
}
