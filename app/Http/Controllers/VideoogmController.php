<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class VideoogmController extends Controller
{
   
    public function showvideomodogm(Request $request)
    {
        $search = $request->input('search');
        $videoogm = DB::table('videoogm')
                        ->when($search, function($query, $search) {
                            return $query->where('judulvidogm', 'like', '%'.$search.'%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(10);

        return view('modogm', ['videoogm' => $videoogm]);
    }

    public function addvidmodogm()
    {
        return view('addvidmodogm');
    }

    public function addvidmodogm_process(Request $request)
    {
        $request->validate([
            'judulvidogm' => 'required',
            'linkogm' => 'required|url', // Memvalidasi input link sebagai URL
        ]);

        try {
            DB::table('videoogm')->insert([
                'judulvidogm' => $request->input('judulvidogm'),
                'linkogm' => $request->input('linkogm'),
            ]);
            return redirect()->route('videoogm.show_by_adminvidogmshow')->with('success', 'Video berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
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
                        ->when($search, function($query, $search) {
                            return $query->where('judulvidogm', 'like', '%'.$search.'%');
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
            'linkogm' => 'required|url', // Memvalidasi input link sebagai URL
        ]);

        $id = $request->id;
        $judulvidogm = $request->judulvidogm;

        $videoogm = DB::table('videoogm')->where('id', $id)->first();
        $linkogmLama = $videoogm->linkogm;

        try {
            DB::table('videoogm')->where('id', $id)->update([
                'judulvidogm' => $judulvidogm,
                'linkogm' => $request->input('linkogm'),
            ]);

            Session::flash('success', 'Video berhasil diupdate.');
            return redirect()->route('videoogm.show_by_adminvidogmshow');
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
