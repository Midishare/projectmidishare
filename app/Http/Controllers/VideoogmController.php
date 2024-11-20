<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VideoogmController extends Controller
{

    public function showvideomodogm(Request $request)
    {
        try {
            $search = $request->input('search');
            $videoogm = DB::table('videoogm')
                ->when($search, function ($query, $search) {
                    return $query->where('judulvidogm', 'like', '%' . $search . '%');
                })
                ->orderBy('id', 'desc')
                ->paginate(9);

            return view('modogm', ['videoogm' => $videoogm]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
        }
    }



    public function addvidmodogm()
    {
        return view('addvidmodogm');
    }

    public function addvidmodogm_process(Request $request)
    {
        $request->validate([
            'judulvidogm' => 'required|string|max:255',
            'linkogm' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $linkogm = $request->input('linkogm');

        if (!(strpos($linkogm, 'youtube.com') !== false || strpos($linkogm, 'youtu.be') !== false || strpos($linkogm, 'drive.google.com') !== false)) {
            return redirect()->back()->withErrors(['error' => 'Please enter a valid YouTube or Google Drive URL.']);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
        }

        try {
            DB::table('videoogm')->insert([
                'judulvidogm' => $request->input('judulvidogm'),
                'linkogm' => $linkogm,
                'image_path' => $imagePath,
            ]);
            return redirect()->route('videoogm.show_by_adminvidogmshow')->with('success', 'Video successfully added.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    }




    public function detailvidogm($id)
    {
        $videoogm = DB::table('videoogm')->where('id', $id)->first();
        return view('detailvidogm', ['videoogm' => $videoogm]);
    }


    public function show_by_adminvidogmshow(Request $request)
    {
        $search = $request->input('search');

        $videoogm = DB::table('videoogm')
            ->when($search, function ($query, $search) {
                return $query->where('judulvidogm', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view('showvideomodogm', ['videoogm' => $videoogm]);
    }


    public function editvidogm($id)
    {
        $videoogm = DB::table('videoogm')->where('id', $id)->first();
        return view('editvidmodogm', ['videoogm' => $videoogm]);
    }

    public function editvidogm_process(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'judulvidogm' => 'required|string|max:255',
            'linkogm' => 'required|url',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $id = $request->input('id');
        $linkogm = $request->input('linkogm');

        if (!(strpos($linkogm, 'youtube.com') !== false || strpos($linkogm, 'youtu.be') !== false || strpos($linkogm, 'drive.google.com') !== false)) {
            return redirect()->back()->withErrors(['error' => 'Please enter a valid YouTube or Google Drive URL.']);
        }

        $videoogm = DB::table('videoogm')->where('id', $id)->first();
        $imagePath = $videoogm->image_path;

        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::delete($imagePath);
            }
            $imagePath = $request->file('image')->store('public/images');
        }

        try {
            DB::table('videoogm')->where('id', $id)->update([
                'judulvidogm' => $request->input('judulvidogm'),
                'linkogm' => $linkogm,
                'image_path' => $imagePath,
            ]);
            return redirect()->route('videoogm.show_by_adminvidogmshow')->with('success', 'Video successfully updated.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred. Please try again.']);
        }
    }



    public function deletevidmodogm($id)
    {
        $videoogm = DB::table('videoogm')->where('id', $id)->first();

        if (!$videoogm) {
            return redirect()->back()->withErrors(['error' => 'Video tidak ditemukan.']);
        }

        if (isset($videoogm->dokumenvideoogm)) {
            $dokumenPath = $videoogm->dokumenvideoogm;

            try {
                Storage::delete('public/dokumen/' . $dokumenPath);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Gagal menghapus file.']);
            }
        }

        try {
            DB::table('videoogm')->where('id', $id)->delete();
            Session::flash('success', 'Video berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }

        return redirect()->route('videoogm.show_by_adminvidogmshow');
    }


    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('selected_videos');

        if ($ids) {
            $videos = DB::table('videoogm')->whereIn('id', $ids)->get();

            foreach ($videos as $video) {
                if (isset($video->dokumenvideoogm)) {
                    Storage::delete('public/dokumen/' . $video->dokumenvideoogm);
                }
            }

            DB::table('videoogm')->whereIn('id', $ids)->delete();

            Session::flash('success', 'Video yang dipilih berhasil dihapus.');
        } else {
            Session::flash('error', 'Tidak ada video yang dipilih.');
        }

        return redirect()->route('videoogm.show_by_adminvidogmshow');
    }
}
