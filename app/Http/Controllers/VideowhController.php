<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class VideowhController extends Controller
{

    public function showvideomodwh(Request $request)
    {
        // Mendapatkan kata kunci pencarian dari input form
        $search = $request->input('search');

        // Query data dengan pagination
        $videowh = DB::table('videowh')
                        ->when($search, function($query, $search) {
                            // Jika terdapat kata kunci pencarian, tambahkan kondisi WHERE
                            return $query->where('judulvidwh', 'like', '%'.$search.'%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(10); // Menampilkan 10 video per halaman

        return view('modwh', ['videowh' => $videowh]);
    }

    public function addvidmodwh()
    {
        return view('addvidmodwh');
    }

    // public function addvidmodwh_process(Request $request)
    // {
    //     $request->validate([
    //         'judulvidwh' => 'required',
    //         'dokumenvideowh' => 'required|mimes:mp4,mkv,avi,mpg,webm',
    //     ]);

    //     try {
    //         if ($request->hasFile('dokumenvideowh') && $request->file('dokumenvideowh')->isValid()) {
    //             $file = $request->file('dokumenvideowh');
    //             $dokumenNama = $file->getClientOriginalName(); 
    //             $file->storeAs('public/dokumen', $dokumenNama);
    //             DB::table('videowh')->insert([
    //                 'judulvidwh' => $request->input('judulvidwh'),
    //                 'dokumenvideowh' => $dokumenNama,
    //             ]);

    //             return redirect()->route('videowh.show_by_adminvidwhshow')->with('success', 'Video berhasil ditambahkan.');
    //         } else {
    //             throw new \Exception('Invalid video file.');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
    //     }
    // }

    public function addvidmodwh_process(Request $request)
    {
        $request->validate([
            'judulvidwh' => 'required',
            'linkwh' => 'required|url', // Memvalidasi input link sebagai URL
        ]);

        try {
            DB::table('videowh')->insert([
                'judulvidwh' => $request->input('judulvidwh'),
                'linkwh' => $request->input('linkwh'),
            ]);
            return redirect()->route('videowh.show_by_adminvidwhshow')->with('success', 'Video berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function detailvidwh($id)
    {
        $videowh = DB::table('videowh')->where('id', $id)->first();
        return view('detailvidwh', ['videowh' => $videowh]);
    }

    // public function show_by_adminvidwhshow()
    // {
    //     $videowh = DB::table('videowh')->orderBy('id', 'desc')->get();
    //     return view('showvideomodwh', ['videowh' => $videowh]);
    // }

    public function show_by_adminvidwhshow(Request $request)
    {
        $search = $request->input('search');
        
        // Query data dengan pagination
        $videowh = DB::table('videowh')
                        ->when($search, function($query, $search) {
                            return $query->where('judulvidwh', 'like', '%'.$search.'%');
                        })
                        ->orderBy('id', 'desc')
                        ->paginate(9); // Menampilkan 9 video per halaman
        
        return view('showvideomodwh', ['videowh' => $videowh]);
    }

    public function editvidwh($id)
    {
        $videowh = DB::table('videowh')->where('id', $id)->first();
        return view('editvidmodwh', ['videowh' => $videowh]);
    }

    // public function editvidwh_process(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required',
    //         'judulvidwh' => 'required',
    //         'dokumenvideowh' => 'nullable|mimes:mp4,mkv,avi,mpg,webm',
    //     ]);

    //     $id = $request->id;
    //     $judulvidwh = $request->judulvidwh;

    //     $videowh = DB::table('videowh')->where('id', $id)->first();
    //     $dokumenLama = $videowh->dokumenvideowh;

    //     try {
    //         $dokumenNama = $dokumenLama;

    //         // if ($request->hasFile('dokumenvideowh')):
    //         //     Storage::delete('public/dokumen/' . $dokumenLama);
    //         //     $dokumenPath = $request->file('dokumenvideowh')->store('public/dokumen');
    //         //     $dokumenNama = basename($dokumenPath);
    //         // endif;

    //         if ($request->hasFile('dokumenvideowh')):
    //             $uploadedFile = $request->file('dokumenvideowh');
    //             if ($uploadedFile->isValid()) {
    //                 Storage::delete('public/dokumen/' . $dokumenLama);
    //                 $dokumenPath = $uploadedFile->store('public/dokumen');
    //                 $dokumenNama = basename($dokumenPath);
    //             } else {
    //                 throw new \Exception('File yang diunggah tidak valid.');
    //             }
    //         endif;

            
    //         DB::table('videowh')->where('id', $id)->update([
    //             'judulvidwh' => $judulvidwh,
    //             'dokumenvideowh' => $dokumenNama,
    //         ]);

    //         Session::flash('success', 'Video berhasil diupdate.');
    //         return redirect()->route('videowh.show_by_adminvidwhshow');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
    //     }
    // }

    public function editvidwh_process(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'judulvidwh' => 'required',
            'linkwh' => 'required|url', // Memvalidasi input link sebagai URL
        ]);

        $id = $request->id;
        $judulvidwh = $request->judulvidwh;

        $videowh = DB::table('videowh')->where('id', $id)->first();
        $linkwhLama = $videowh->linkwh;

        try {
            DB::table('videowh')->where('id', $id)->update([
                'judulvidwh' => $judulvidwh,
                'linkwh' => $request->input('linkwh'),
            ]);

            Session::flash('success', 'Video berhasil diupdate.');
            return redirect()->route('videowh.show_by_adminvidwhshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function deletevidmodwh($id)
{
    $videowh = DB::table('videowh')->where('id', $id)->first();

    if (!$videowh) {
        // Handle video not found
        return redirect()->back()->withErrors(['error' => 'Video tidak ditemukan.']);
    }

    // Periksa apakah properti 'dokumenvideowh' ada sebelum mencoba menghapus file
    if (isset($videowh->dokumenvideowh)) {
        $dokumenPath = $videowh->dokumenvideowh;

        try {
            Storage::delete('public/dokumen/' . $dokumenPath);
        } catch (\Exception $e) {
            // Handle file deletion error
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus file.']);
        }
    }

    try {
        DB::table('videowh')->where('id', $id)->delete();
        Session::flash('success', 'Video berhasil dihapus.');
    } catch (\Exception $e) {
        // Handle database deletion error
        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
    }

    return redirect()->route('videowh.show_by_adminvidwhshow');
}

public function deleteMultiplewh(Request $request)
    {
        $ids = $request->input('selected_videos');
    
        if ($ids) {
            $videos = DB::table('videowh')->whereIn('id', $ids)->get();
            
            foreach ($videos as $video) {
                if (isset($video->dokumenvideowh)) {
                    Storage::delete('public/dokumen/' . $video->dokumenvideowh);
                }
            }
    
            DB::table('videowh')->whereIn('id', $ids)->delete();
    
            Session::flash('success', 'Video yang dipilih berhasil dihapus.');
        } else {
            Session::flash('error', 'Tidak ada video yang dipilih.');
        }
    
        return redirect()->route('videowh.show_by_adminvidwhshow');
    } 

}
