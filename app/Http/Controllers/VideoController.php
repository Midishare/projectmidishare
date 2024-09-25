<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class VideoController extends Controller
{
    public function showvideomod(Request $request)
    {
        $search = $request->input('search');

        $videomod = DB::table('videomod')
                        ->when($search, function($query, $search) {
                            return $query->where('judulvidmod', 'like', '%'.$search.'%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(10); 

        return view('modkm', ['videomod' => $videomod]);
    }

    public function addvidmod_process(Request $request)
    {
        $request->validate([
            'judulvidmod' => 'required',
            'linkmod' => 'required|url', // Memvalidasi input link sebagai URL
        ]);

        try {
            DB::table('videomod')->insert([
                'judulvidmod' => $request->input('judulvidmod'),
                'linkmod' => $request->input('linkmod'),
            ]);

            // Redirect dengan pesan sukses jika berhasil menyimpan
            return redirect()->route('video.show_by_adminvidshow')->with('success', 'Video berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function addvidmod()
    {
        return view('addvidmod');
    }

    public function detailvidmod($id)
    {
        $videomod = DB::table('videomod')->where('id', $id)->first();
        return view('detailvidmod', ['videomod' => $videomod]);
    }

    // public function show_by_adminvidshow()
    // {
    //     $videomod = DB::table('videomod')->orderBy('id', 'desc')->get();
    //     return view('showvideomod', ['videomod' => $videomod]);
    // }

    public function show_by_adminvidshow(Request $request)
    {
        $search = $request->input('search');
        
        // Query data dengan pagination
        $videomod = DB::table('videomod')
                        ->when($search, function($query, $search) {
                            return $query->where('judulvidmod', 'like', '%'.$search.'%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(9); // Menampilkan 9 video per halaman
        
        return view('showvideomod', ['videomod' => $videomod]);
    }

    public function editvidmod($id)
    {
        $videomod = DB::table('videomod')->where('id', $id)->first();
        return view('editvidmod', ['videomod' => $videomod]);
    }

    public function editvid_process(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'judulvidmod' => 'required',
            'linkmod' => 'required|url', // Memvalidasi input link sebagai URL
        ]);

        $id = $request->id;
        $judulvidmod = $request->judulvidmod;

        $videomod = DB::table('videomod')->where('id', $id)->first();
        $linkmodLama = $videomod->linkmod;

        try {
            DB::table('videomod')->where('id', $id)->update([
                'judulvidmod' => $judulvidmod,
                'linkmod' => $request->input('linkmod'),
            ]);

            Session::flash('success', 'Video berhasil diupdate.');
            return redirect()->route('video.show_by_adminvidshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
    
    public function deletevidmod($id)
    {
        $videomod = DB::table('videomod')->where('id', $id)->first();
    
        try {
            // Hapus data dari database
            DB::table('videomod')->where('id', $id)->delete();
    
            Session::flash('success', 'Video berhasil dihapus.');
            return redirect()->route('video.show_by_adminvidshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if ($ids) {
            DB::table('videomod')->whereIn('id', $ids)->delete();
            return redirect()->route('video.show_by_adminvidshow')->with('success', 'Video Berhasil Dihapus');
        }

        return redirect()->route('video.show_by_adminvidshow')->with('error', 'No items selected for deletion.');
    }

    
}
