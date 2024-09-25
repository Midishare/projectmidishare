<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BelajarmandiriController extends Controller
{
    public function showmandiri(Request $request)
    {
        $search = $request->input('search');

        $mandiri = DB::table('mandiri')
            ->when($search, function ($query) use ($search) {
                return $query->where('judul', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(6); // Menggunakan paginate() untuk pagination

        return view('belajarmandiri', compact('mandiri'));
    }

    public function addmandiri()
    {
        return view('addmandiri');
    }

    public function addmandiri_process(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'link' => 'required',
            'gambarmandiri' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarPath = $request->file('gambarmandiri')->store('public/icon');
        $gambarNama = basename($gambarPath);

        DB::table('mandiri')->insert([
            'judul' => $request->input('judul'),
            'link' => $request->input('link'),
            'gambarmandiri' => $gambarNama,
        ]);
        return redirect()->action([BelajarmandiriController::class, 'show_by_adminmandirishow']);
    }

    public function detailmandiri($id)
    {
        $mandiri = DB::table('mandiri')->where('id', $id)->first();
        return view('detailmandiri', ['mandiri' => $mandiri]);
    }

    public function show_by_adminmandirishow(Request $request)
    {
        $search = $request->input('search');

        // Query data "Belajar Mandiri" dengan filter pencarian jika ada
        $mandiri = DB::table('mandiri')
            ->when($search, function ($query) use ($search) {
                return $query->where('judul', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10); // Ganti '10' dengan jumlah item per halaman yang diinginkan

        return view('adminmandirishow', compact('mandiri'));
    }

    public function editmandiri($id)
    {
        $mandiri = DB::table('mandiri')->where('id', $id)->first();
        return view('editmandiri', ['mandiri' => $mandiri]);
    }

    public function editmandiri_process(Request $request)
    {
        $id = $request->id;
        $judul = $request->judul;
        $link = $request->link;
        $mandiri = DB::table('mandiri')->where('id', $id)->first();
        $gambarLama = $mandiri->gambarmandiri;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/icon');
            $gambarNama = basename($gambarPath);
        } else {
            $gambarNama = $gambarLama;
        }
        DB::table('mandiri')->where('id', $id)
            ->update(['judul' => $judul, 'link' => $link, 'gambarmandiri' => $gambarNama]);
        if ($request->hasFile('gambar')) {
            Storage::delete('public/icon/' . $gambarLama);
        }
        Session::flash('success', 'Berita Berhasil diedit');
        return redirect()->route('belajarmandiri.show_by_adminmandirishow');
    }

    public function deletemandiri($id)
    {
        DB::table('mandiri')->where('id', $id)->delete();
        Session::flash('success', 'Berita berhasil dihapus.');
        return redirect()->action([BelajarmandiriController::class, 'show_by_adminmandirishow']);
    }

    public function deleteSelected(Request $request)
    {
        $selectedItems = $request->selectedItems;

        // Periksa apakah $selectedItems tidak null dan merupakan array
        if ($selectedItems !== null && is_array($selectedItems)) {
            try {
                DB::table('mandiri')->whereIn('id', $selectedItems)->delete();
                Session::flash('success', 'Data terpilih berhasil dihapus.');
                return redirect()->route('belajarmandiri.show_by_adminmandirishow');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
            }
        } else {
            // Handle kasus jika $selectedItems adalah null atau bukan array
            return redirect()->back()->withErrors(['error' => 'Tidak ada item yang dipilih untuk dihapus.']);
        }
    }
}
