<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Belajarmandiri;
use Carbon\Carbon;
use DOMDocument;

class BelajarmandiriController extends Controller
{
    public function showmandiri(Request $request)
    {
        $search = $request->input('search');

        $belajarmandiri = Belajarmandiri::when($search, function ($query) use ($search) {
            return $query->where('judul', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate(6);

        return view('belajarmandiri', compact('belajarmandiri'));
    }

    public function addmandiri()
    {
        return view('addmandiri');
    }
    public function showallmandiri()
    {
        return view('belajarmandirichose');
    }

    public function addmandiri_process(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'published_at' => 'required|date',
        ]);

        $judul = $request->judul;
        $deskripsi = $request->deskripsi;
        $published_at = $request->published_at;
        $deskripsi = $this->processSummernoteContent($deskripsi);

        try {
            // Simpan berita ke database
            $belajarmandiri = new Belajarmandiri();
            $belajarmandiri->judul = $judul;
            $belajarmandiri->deskripsi = $deskripsi;
            $belajarmandiri->published_at = Carbon::parse($published_at);

            // Simpan gambar
            if ($request->hasFile('gambar')) {
                $gambarPath = $request->file('gambar')->store('public/icon');
                $gambarNama = basename($gambarPath);
                $belajarmandiri->gambar = $gambarNama;
            }

            $belajarmandiri->save();

            Session::flash('success', 'Belajarmandiri berhasil ditambahkan.');
            return redirect()->route('belajarmandiri.show_by_adminmandirishow');
        } catch (\Exception $e) {
            Log::error('Error adding news: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    // Fungsi edit juga perlu diperbaiki dengan cara yang sama
    public function editmandiri_process(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'published_at' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $id = $request->id;
        $judul = $request->judul;
        $deskripsi = $request->deskripsi;
        $published_at = $request->published_at;

        $belajarmandiri = Belajarmandiri::findOrFail($id);

        $belajarmandiri->deskripsi = $this->processSummernoteContent($deskripsi);
        $belajarmandiri->judul = $judul;
        $belajarmandiri->published_at = Carbon::parse($published_at);

        if ($request->hasFile('gambar')) {
            if ($belajarmandiri->gambar && Storage::exists('public/icon/' . $belajarmandiri->gambar)) {
                Storage::delete('public/icon/' . $belajarmandiri->gambar);
            }
            $gambarPath = $request->file('gambar')->store('public/icon');
            $gambarNama = basename($gambarPath);
            $belajarmandiri->gambar = $gambarNama;
        }

        $belajarmandiri->save();

        Session::flash('success', 'Belajar mandiri berhasil diedit.');
        return redirect()->route('belajarmandiri.show_by_adminmandirishow');
    }

    private function processSummernoteContent($content)
    {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $image) {
            $data = base64_decode(explode(',', explode(';', $image->getAttribute('src'))[1])[1]);
            $imagePath = 'public/icon/' . time() . rand() . '.png';

            Storage::put($imagePath, $data);
            $image->setAttribute('src', asset('storage/' . $imagePath));
        }

        return $dom->saveHTML();
    }

    public function detailmandiri($id)
    {
        $belajarmandiri = Belajarmandiri::findOrFail($id);
        return view('detailmandiri', ['belajarmandiri' => $belajarmandiri]);
    }

    public function show_by_adminmandirishow(Request $request)
    {
        $search = $request->input('search');

        $belajarmandiri = Belajarmandiri::when($search, function ($query) use ($search) {
            return $query->where('judul', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate(6);

        // return view('belajarmandirichose', compact('belajarmandiri'));
        return view('adminmandirishow', compact('belajarmandiri'));
    }

    public function editmandiri($id)
    {
        $belajarmandiri = Belajarmandiri::findOrFail($id);
        $belajarmandiri->published_at = Carbon::parse($belajarmandiri->published_at);
        return view('editmandiri', ['belajarmandiri' => $belajarmandiri]);
    }

    public function deletemandiri($id)
    {
        Belajarmandiri::destroy($id);

        Session::flash('success', 'Belajar mandiri berhasil dihapus.');
        return redirect()->route('belajarmandiri.show_by_adminmandirishow');
    }
    public function bulkDeleteMandiri(Request $request)
    {
        $ids = $request->ids;

        if (empty($ids)) {
            return redirect()->back()->withErrors(['error' => 'Tidak ada berita yang dipilih.']);
        }

        try {
            Belajarmandiri::whereIn('id', $ids)->delete();

            Session::flash('success', 'Belajar mandiri berhasil dihapus.');
            return redirect()->route('belajarmandiri.show_by_adminmandirishow');
        } catch (\Exception $e) {
            Log::error('Error deleting news: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}
