<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class KnowledgeogmController extends Controller
{

    public function show_by_adminkmogmshow(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('repositorykmogm')->orderBy('id', 'desc');

        if ($search) {
            $query->where('judulrepoogm', 'like', '%' . $search . '%');
        }

        $repositorykmogm = $query->paginate(6);

        return view('showkmogm', compact('repositorykmogm'));
    }

    public function showkmogm(Request $request)
    {
        $search = $request->input('search');

        $repositorykmogm = DB::table('repositorykmogm')
            ->when($search, function ($query) use ($search) {
                return $query->where('judulrepoogm', 'like', '%' . $search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('repositorykmogm', compact('repositorykmogm'));
    }

    public function addkmogm()
    {
        return view('addkmogm');
    }

    public function addkmogm_process(Request $request)
    {
        $request->validate([
            'judulrepoogm' => 'required',
            'gambarrepoogm' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'dokumenfilerepoogm' => 'required|mimes:pdf,doc,docx,ppt,pptx',
        ]);

        try {
            $gambarPath = $request->file('gambarrepoogm')->store('public/gambar');
            $gambarNama = basename($gambarPath);

            $dokumenPath = $request->file('dokumenfilerepoogm')->store('public/dokumen');
            $dokumenNama = basename($dokumenPath);

            DB::table('repositorykmogm')->insert([
                'judulrepoogm' => $request->input('judulrepoogm'),
                'gambarrepoogm' => $gambarNama,
                'dokumenfilerepoogm' => $dokumenNama,
            ]);

            Session::flash('success', 'Repository berhasil ditambahkan.');
            return redirect()->route('knowledgeogm.show_by_adminkmogmshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function editkmogm($id)
    {
        $repositorykmogm = DB::table('repositorykmogm')->where('id', $id)->first();
        return view('editkmogm', ['repositorykmogm' => $repositorykmogm]);
    }

    public function editkmogm_process(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'judulrepoogm' => 'required',
            'gambarrepoogm' => 'image|mimes:jpeg,png,jpg|max:2048',
            'dokumenfilerepoogm' => 'mimes:pdf,doc,docx,ppt,pptx|max:2048', // Memperbarui validasi untuk memasukkan doc dan docx
        ]);

        $id = $request->id;

        $repositorykmogm = DB::table('repositorykmogm')->where('id', $id)->first();
        if (!$repositorykmogm) {
            return redirect()->back()->withErrors(['error' => 'Data repository tidak ditemukan.']);
        }

        $gambarLama = $repositorykmogm->gambarrepoogm;

        try {
            $updateData = [
                'judulrepoogm' => $request->input('judulrepoogm'),
                'dokumenfilerepoogm' => $repositorykmogm->dokumenfilerepoogm,
            ];

            if ($request->hasFile('gambarrepoogm')) {
                $gambarPath = $request->file('gambarrepoogm')->store('public/gambar');
                $gambarNama = basename($gambarPath);
                $updateData['gambarrepoogm'] = $gambarNama;

                // Hapus gambar lama jika ada
                Storage::delete('public/gambar/' . $gambarLama);
            }

            if ($request->hasFile('dokumenfilerepoogm')) {
                $dokumenPath = $request->file('dokumenfilerepoogm')->store('public/dokumen');
                $dokumenNama = basename($dokumenPath);
                $updateData['dokumenfilerepoogm'] = $dokumenNama;
            }

            DB::table('repositorykmogm')->where('id', $id)->update($updateData);

            Session::flash('success', 'Repository berhasil diedit.');
            return redirect()->route('knowledgeogm.show_by_adminkmogmshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function deletekmogm($id)
    {
        $repositorykmogm = DB::table('repositorykmogm')->where('id', $id)->first();
        $gambarLama = $repositorykmogm->gambarrepoogm;

        try {
            Storage::delete('public/dokumen/' . $repositorykmogm->dokumenfilerepoogm);

            DB::table('repositorykmogm')->where('id', $id)->delete();

            Storage::delete('public/gambar/' . $gambarLama);

            Session::flash('success', 'Repository berhasil dihapus.');
            return redirect()->route('knowledgeogm.show_by_adminkmogmshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function deleteSelected(Request $request)
    {
        $selectedItems = $request->input('selectedItems');

        if (!$selectedItems) {
            return redirect()->back()->withErrors(['error' => 'Pilih setidaknya satu item untuk dihapus.']);
        }

        try {
            foreach ($selectedItems as $id) {
                $repositorykmogm = DB::table('repositorykmogm')->where('id', $id)->first();

                if ($repositorykmogm) {
                    Storage::delete('public/dokumen/' . $repositorykmogm->dokumenfilerepoogm);
                    Storage::delete('public/gambar/' . $repositorykmogm->gambarrepoogm);
                    DB::table('repositorykmogm')->where('id', $id)->delete();
                }
            }

            Session::flash('success', 'Item terpilih berhasil dihapus.');
            return redirect()->route('knowledgeogm.show_by_adminkmogmshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}
