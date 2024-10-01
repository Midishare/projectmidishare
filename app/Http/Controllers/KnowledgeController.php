<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class KnowledgeController extends Controller
{
    public function showkm(Request $request)
    {
        $search = $request->input('search');

        $repositorykm = DB::table('repositorykm')
            ->when($search, function ($query) use ($search) {
                return $query->where('judul', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('repositorykm', ['repositorykm' => $repositorykm]);
    }

    public function addkm()
    {
        return view('addkm');
    }

    public function addkm_process(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'dokumenfile' => 'required|mimes:pdf,doc,docx,ppt,pptx',
        ]);

        try {
            $gambarPath = $request->file('gambar')->store('public/gambar');
            $gambarNama = basename($gambarPath);

            $dokumenPath = $request->file('dokumenfile')->store('public/dokumen');
            $dokumenNama = basename($dokumenPath);

            DB::table('repositorykm')->insert([
                'judul' => $request->input('judul'),
                'gambar' => $gambarNama,
                'dokumenfile' => $dokumenNama,
            ]);

            Session::flash('success', 'Repository berhasil ditambahkan.');
            return redirect()->route('knowledge.show_by_adminkmshow');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function detailkm($id)
    {
        $repositorykm = DB::table('repositorykm')->where('id', $id)->first();
        return view('detailkm', ['repositorykm' => $repositorykm]);
    }


    public function show_by_adminkmshow(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('repositorykm')->orderBy('id', 'desc');

        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%');
        }

        $repositorykm = $query->paginate(6);

        return view('showkm', compact('repositorykm'));
    }

    public function editkm($id)
    {
        $repositorykm = DB::table('repositorykm')->where('id', $id)->first();
        return view('editkm', ['repositorykm' => $repositorykm]);
    }

    public function editkm_process(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'dokumenfile' => 'mimes:pdf,doc,docx,ppt,pptx', // Menambahkan docx
        ]);

        $id = $request->id;

        $repositorykm = DB::table('repositorykm')->where('id', $id)->first();
        $gambarLama = $repositorykm->gambar;

        try {
            $updateData = [
                'judul' => $request->input('judul'),
                'dokumenfile' => $repositorykm->dokumenfile,
            ];

            if ($request->hasFile('gambar')) {
                // Simpan file gambar baru
                $gambarPath = $request->file('gambar')->store('public/gambar');
                $gambarNama = basename($gambarPath);
                $updateData['gambar'] = $gambarNama;

                // Hapus gambar lama
                Storage::delete('public/gambar/' . $gambarLama);
            }

            if ($request->hasFile('dokumenfile')) {
                // Simpan file dokumen baru
                $dokumenPath = $request->file('dokumenfile')->store('public/dokumen');
                $dokumenNama = basename($dokumenPath);
                $updateData['dokumenfile'] = $dokumenNama;
            }

            DB::table('repositorykm')->where('id', $id)->update($updateData);

            Session::flash('success', 'Repository berhasil diedit.');
            return redirect()->route('knowledge.show_by_adminkmshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }


    public function deletekm($id)
    {
        DB::table('repositorykm')->where('id', $id)->delete();
        Session::flash('success', 'Berita berhasil dihapus.');
        return redirect()->route('knowledge.show_by_adminkmshow');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if ($ids) {
            DB::table('repositorykm')->whereIn('id', $ids)->delete();
            return redirect()->route('knowledge.show_by_adminkmshow')->with('success', 'Berhasil dihapus.');
        }

        return redirect()->route('knowledge.show_by_adminkmshow')->with('error', 'No items selected for deletion.');
    }
}
