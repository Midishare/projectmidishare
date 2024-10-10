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
        $user = Auth::user();

        if ($user->class == 'SME') {

            $search = $request->input('search');
            $videoogm = DB::table('videoogm')
                ->when($search, function ($query, $search) {
                    return $query->where('judulvidogm', 'like', '%' . $search . '%');
                })
                ->orderBy('id', 'desc')
                ->paginate(9); // or paginate(10) based on your requirement


            // Looping untuk setiap video untuk menyiapkan thumbnail URL
            foreach ($videoogm as $video) {
                $video_id = '';
                $video_url = $video->linkogm;

                // Cek apakah URL adalah YouTube
                if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
                    $url_parts = parse_url($video_url);

                    if (isset($url_parts['query'])) {
                        parse_str($url_parts['query'], $query);
                        if (isset($query['v'])) {
                            $video_id = $query['v']; // Mendapatkan ID video dari parameter 'v'
                        }
                    } elseif (isset($url_parts['path'])) {
                        $path_parts = explode('/', trim($url_parts['path'], '/'));
                        $video_id = end($path_parts); // Untuk URL singkat youtu.be
                    }

                    // Set thumbnail URL jika ID video ditemukan
                    if ($video_id) {
                        $video->thumbnail_url = "https://img.youtube.com/vi/{$video_id}/hqdefault.jpg";
                    } else {
                        $video->thumbnail_url = null;
                    }
                } else {
                    $video->thumbnail_url = null;
                }
            }
            return view('modogm', ['videoogm' => $videoogm]);
        }
        return redirect()->back()->withErrors(['access' => 'You do not have access to this section.']);
    }



    public function addvidmodogm()
    {
        return view('addvidmodogm');
    }

    public function addvidmodogm_process(Request $request)
    {
        $request->validate([
            'judulvidogm' => 'required',
            'linkogm' => 'required|url', // Memvalidasi bahwa input adalah URL
        ]);

        // Memeriksa apakah link adalah link YouTube
        $linkogm = $request->input('linkogm');
        if (strpos($linkogm, 'youtube.com') === false && strpos($linkogm, 'youtu.be') === false) {
            return redirect()->back()->withErrors(['error' => 'Harap masukkan URL YouTube yang valid.']);
        }

        try {
            DB::table('videoogm')->insert([
                'judulvidogm' => $request->input('judulvidogm'),
                'linkogm' => $linkogm,
            ]);
            return redirect()->route('videoogm.show_by_adminvidogmshow')->with('success', 'Video berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
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
            'judulvidogm' => 'required',
            'linkogm' => 'required|url',
        ]);

        $id = $request->input('id');
        $linkogm = $request->input('linkogm');

        // Memeriksa apakah link yang diedit adalah link YouTube
        if (strpos($linkogm, 'youtube.com') === false && strpos($linkogm, 'youtu.be') === false) {
            return redirect()->back()->withErrors(['error' => 'Harap masukkan URL YouTube yang valid.']);
        }

        try {
            DB::table('videoogm')->where('id', $id)->update([
                'judulvidogm' => $request->input('judulvidogm'),
                'linkogm' => $linkogm,
            ]);
            return redirect()->route('videoogm.show_by_adminvidogmshow')->with('success', 'Video berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }


    // public function deletevidmodogm($id)
    // {
    //     $videoogm = DB::table('videoogm')->where('id', $id)->first();
    //     $dokumenPath = $videoogm->dokumenvideoogm;

    //     try {
    //         Storage::delete('public/dokumen/' . $dokumenPath);
    //         DB::table('videoogm')->where('id', $id)->delete();
    //         Session::flash('success', 'Video berhasil dihapus.');
    //         return redirect()->route('videoogm.show_by_adminvidogmshow');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
    //     }
    // }

    public function deletevidmodogm($id)
    {
        $videoogm = DB::table('videoogm')->where('id', $id)->first();

        if (!$videoogm) {
            // Handle video not found
            return redirect()->back()->withErrors(['error' => 'Video tidak ditemukan.']);
        }

        // Periksa apakah properti 'dokumenvideoogm' ada sebelum mencoba menghapus file
        if (isset($videoogm->dokumenvideoogm)) {
            $dokumenPath = $videoogm->dokumenvideoogm;

            try {
                Storage::delete('public/dokumen/' . $dokumenPath);
            } catch (\Exception $e) {
                // Handle file deletion error
                return redirect()->back()->withErrors(['error' => 'Gagal menghapus file.']);
            }
        }

        try {
            DB::table('videoogm')->where('id', $id)->delete();
            Session::flash('success', 'Video berhasil dihapus.');
        } catch (\Exception $e) {
            // Handle database deletion error
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
                // Periksa apakah properti 'dokumenvideoogm' ada sebelum menghapus file
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
