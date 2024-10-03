<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Livestream; // Ensure this is included

class LivestreamController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to view the livestream.');
        }

        // Fetch the livestream URL
        $livestream = DB::table('livestreams')->latest()->first();

        return view('livestream', ['livestream' => $livestream]);
    }

    public function adminView()
    {
        // Fetch the latest livestream URL from the database
        $livestream = DB::table('livestreams')->latest()->first();

        return view('admin.livestream', ['livestream' => $livestream]);
    }

    // Admin function to update the livestream URL
    public function updateLivestream(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        // Extract the video ID from the provided YouTube URL
        $videoId = $this->getVideoId($request->url);

        if ($videoId) {
            // Save the embed URL to the database
            DB::table('livestreams')->updateOrInsert(
                ['id' => 1], // Assuming only one livestream record
                ['url' => 'https://www.youtube.com/embed/' . $videoId]
            );

            return redirect()->back()->with('success', 'Livestream URL updated successfully.');
        }

        return redirect()->back()->with('error', 'Invalid YouTube URL.');
    }

    // Method to delete the livestream URL
    public function deleteLivestream()
    {
        // Delete the livestream record
        DB::table('livestreams')->where('id', 1)->delete();

        return redirect()->back()->with('success', 'Livestream URL deleted successfully.');
    }

    private function getVideoId($url)
    {
        // Use regex to extract the video ID from the URL
        preg_match('/(?:live\/|v\/|\/)([0-9A-Za-z_-]{11})/', $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }
}
