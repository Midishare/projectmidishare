<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\News;
use Carbon\Carbon;
use DOMDocument;

class BeritaController extends Controller
{
    public function show(Request $request)
    {
        $search = $request->input('search');

        $news = News::when($search, function ($query) use ($search) {
            return $query->where('judul', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate(6);

        return view('beritamidi', ['news' => $news]);
    }

    public function kmadmin()
    {

        return view('kmadmin');
    }

    public function materiadmin()
    {

        return view('materiadmin');
    }

    public function generallearnadmin()
    {

        return view('generallearnadmin');
    }

    public function materiadminmodogm()
    {

        return view('materiadminmodogm');
    }

    public function repositoryall()
    {

        return view('repositoryall');
    }
    public function helpcenter()
    {

        return view('helpcenter');
    }

    public function add()
    {
        return view('add');
    }

    public function belajarmandiriall()
    {
        return view('belajarmandiriall');
    }

    public function add_process(Request $request)
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
            $news = new News();
            $news->judul = $judul;
            $news->deskripsi = $deskripsi;
            $news->published_at = Carbon::parse($published_at);
            if ($request->hasFile('gambar')) {
                $gambarPath = $request->file('gambar')->store('public/icon');
                $gambarNama = basename($gambarPath);
                $news->gambar = $gambarNama;
            }

            $news->save();

            Session::flash('success', 'Berita berhasil ditambahkan.');
            return redirect()->route('berita.show_by_admin');
        } catch (\Exception $e) {
            Log::error('Error adding news: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
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

    public function detail($id)
    {
        $news = News::findOrFail($id);
        return view('detail', ['news' => $news]);
    }

    public function show_by_admin(Request $request)
    {
        $search = $request->input('search');

        $news = News::when($search, function ($query) use ($search) {
            return $query->where('judul', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate(6);

        return view('adminshow', compact('news'));
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $news->published_at = Carbon::parse($news->published_at);
        return view('edit', ['news' => $news]);
    }


    public function edit_process(Request $request)
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

        $news = News::findOrFail($id);

        $news->deskripsi = $this->processSummernoteContent($deskripsi);
        $news->judul = $judul;
        $news->published_at = Carbon::parse($published_at);

        if ($request->hasFile('gambar')) {
            if ($news->gambar && Storage::exists('public/icon/' . $news->gambar)) {
                Storage::delete('public/icon/' . $news->gambar);
            }
            $gambarPath = $request->file('gambar')->store('public/icon');
            $gambarNama = basename($gambarPath);
            $news->gambar = $gambarNama;
        }

        $news->save();

        Session::flash('success', 'Berita berhasil diedit.');
        return redirect()->route('berita.show_by_admin');
    }

    public function delete($id)
    {
        News::destroy($id);

        Session::flash('success', 'Berita berhasil dihapus.');
        return redirect()->route('berita.show_by_admin');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        if (empty($ids)) {
            return redirect()->back()->withErrors(['error' => 'Tidak ada berita yang dipilih.']);
        }

        try {
            News::whereIn('id', $ids)->delete();

            Session::flash('success', 'Berita berhasil dihapus.');
            return redirect()->route('berita.show_by_admin');
        } catch (\Exception $e) {
            Log::error('Error deleting news: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}
