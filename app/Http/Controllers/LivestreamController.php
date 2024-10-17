<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Livestream; 

class LivestreamController extends Controller
{
    public function index()
    {
        $livestream = DB::table('livestreams')->latest()->first();

        return view('livestream', ['livestream' => $livestream]);
    }

    public function adminView()
    {
        $livestream = DB::table('livestreams')->latest()->first();

        return view('admin.livestream', ['livestream' => $livestream]);
    }

    public function updateLivestream(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);
        $videoId = $this->getVideoId($request->url);

        if ($videoId) {
            DB::table('livestreams')->updateOrInsert(
                ['id' => 1], 
                ['url' => 'https://www.youtube.com/embed/' . $videoId]
            );

            return redirect()->back()->with('success', 'Livestream URL updated successfully.');
        }

        return redirect()->back()->with('error', 'Invalid YouTube URL.');
    }

    public function deleteLivestream()
    {
        DB::table('livestreams')->where('id', 1)->delete();

        return redirect()->back()->with('success', 'Livestream URL deleted successfully.');
    }

    private function getVideoId($url)
    {
        preg_match('/(?:live\/|v\/|\/)([0-9A-Za-z_-]{11})/', $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }
}
