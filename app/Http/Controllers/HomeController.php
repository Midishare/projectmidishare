<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    public function showhome()
    {
        $home = DB::table('home')->orderBy('id', 'desc')->get();
        return view('welcome', ['home' => $home]);
    }
   
    public function addhome()
    {
        return view('addhome');
    }

    public function addhome_process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Simpan file gambar
            $gambarPath = $request->file('image')->store('public/gambar');
            $gambarNama = basename($gambarPath);

            DB::table('home')->insert([
                'image' => $gambarNama,
            ]);

            Session::flash('success', 'Gambar berhasil ditambahkan.');
            return redirect()->route('home.show_by_adminhomeshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function show_by_adminhomeshow()
    {
        $home = DB::table('home')->orderBy('id', 'desc')->get();
        return view('showhome', ['home' => $home]);
    }



    public function edithome($id)
    {
        $home = DB::table('home')->where('id', $id)->first();
        return view('edithome', ['home' => $home]);
    }

    public function edithome_process(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $id = $request->id;

            $home = DB::table('home')->where('id', $id)->first();
            $gambarLama = $home->image;

            $updateData = [];

            if ($request->hasFile('image')) {
                // Simpan file gambar baru
                $gambarPath = $request->file('image')->store('public/gambar');
                $gambarNama = basename($gambarPath);
                $updateData['image'] = $gambarNama;

                Storage::delete('public/gambar/' . $gambarLama);
            }

            DB::table('home')->where('id', $id)->update($updateData);

            Session::flash('success', 'Home berhasil diedit.');
            return redirect()->route('home.show_by_adminhomeshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    // public function deletehome($id)
    // {
    //     try {
    //         $home = DB::table('home')->where('id', $id)->first();
    //         $gambar = $home->image;

    //         Storage::delete('public/gambar/' . $gambar);

    //         DB::table('home')->where('id', $id)->delete();

    //         Session::flash('success', 'Home berhasil dihapus.');
    //         return redirect()->action([HomeController::class, 'show_by_adminhomeshow']);
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
    //     }
    // }

    public function deletehome($id)
    {
        try {
            $home = DB::table('home')->where('id', $id)->first();
            if (!$home) {
                return redirect()->back()->withErrors(['error' => 'Home tidak ditemukan.']);
            }

            $gambar = $home->image;

            if ($gambar) {
                Storage::delete('public/gambar/' . $gambar);
            }

            DB::table('home')->where('id', $id)->delete();

            Session::flash('success', 'Home berhasil dihapus.');
            return redirect()->action([HomeController::class, 'show_by_adminhomeshow']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}
