<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class KnowledgewhController extends Controller
{
    public function show_by_adminkmwhshow(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('repositorykmwh')->orderBy('id', 'desc');

        if ($search) {
            $query->where('judulrepowh', 'like', '%' . $search . '%');
        }

        $repositorykmwh = $query->paginate(6);

        return view('showkmwh', compact('repositorykmwh'));
    }

    public function showkmwh(Request $request)
    {
        $search = $request->input('search');

        $query = DB::table('repositorykmwh')->orderBy('id', 'desc');

        if ($search) {
            $query->where('judulrepowh', 'like', '%' . $search . '%');
        }

        $repositorykmwh = $query->paginate(6);

        return view('repositorykmwh', compact('repositorykmwh'));
    }

    public function addkmwh()
    {
        return view('addkmwh');
    }

    public function addkmwh_process(Request $request)
    {
        $request->validate([
            'judulrepowh' => 'required',
            'gambarrepowh' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'dokumenfilerepowh' => 'required|mimes:pdf,doc,docx,ppt,pptx',
        ]);

        try {
            $gambarPath = $request->file('gambarrepowh')->store('public/gambar');
            $gambarNama = basename($gambarPath);

            $dokumenPath = $request->file('dokumenfilerepowh')->store('public/dokumen');
            $dokumenNama = basename($dokumenPath);

            DB::table('repositorykmwh')->insert([
                'judulrepowh' => $request->input('judulrepowh'),
                'gambarrepowh' => $gambarNama,
                'dokumenfilerepowh' => $dokumenNama,
            ]);

            Session::flash('success', 'Repository berhasil ditambahkan.');
            return redirect()->route('knowledgewh.show_by_adminkmwhshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }


    public function editkmwh($id)
    {
        $repositorykmwh = DB::table('repositorykmwh')->where('id', $id)->first();
        return view('editkmwh', ['repositorykmwh' => $repositorykmwh]);
    }

    public function editkmwh_process(Request $request)
    {
        $request->validate([
            'judulrepowh' => 'required',
            'gambarrepowh' => 'image|mimes:jpeg,png,jpg|max:2048',
            'dokumenfilerepowh' => 'mimes:pdf,doc,docx,ppt,pptx|max:2048', // Memperbarui validasi untuk memasukkan doc dan docx
        ]);

        $id = $request->id;

        $repositorykmwh = DB::table('repositorykmwh')->where('id', $id)->first();
        $gambarLama = $repositorykmwh->gambarrepowh;

        try {
            $updateData = [
                'judulrepowh' => $request->input('judulrepowh'),
                'dokumenfilerepowh' => $repositorykmwh->dokumenfilerepowh, // Tetap menggunakan dokumen yang sudah ada
            ];

            if ($request->hasFile('gambarrepowh')) {
                // Simpan file gambar baru
                $gambarPath = $request->file('gambarrepowh')->store('public/gambar');
                $gambarNama = basename($gambarPath);
                $updateData['gambarrepowh'] = $gambarNama;

                // Hapus gambar lama
                Storage::delete('public/gambar/' . $gambarLama);
            }

            if ($request->hasFile('dokumenfilerepowh')) {
                // Simpan file dokumen baru
                $dokumenPath = $request->file('dokumenfilerepowh')->store('public/dokumen');
                $dokumenNama = basename($dokumenPath);
                $updateData['dokumenfilerepowh'] = $dokumenNama;
            }

            DB::table('repositorykmwh')->where('id', $id)->update($updateData);

            Session::flash('success', 'Repository berhasil diedit.');
            return redirect()->route('knowledgewh.show_by_adminkmwhshow');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function deletekmwh($id)
    {
        try {
            $repositorykmwh = DB::table('repositorykmwh')->where('id', $id)->first();

            if (!$repositorykmwh) {
                return redirect()->back()->withErrors(['error' => 'Data repository tidak ditemukan.']);
            }

            if ($repositorykmwh->dokumenfilerepowh) {
                Storage::delete('public/dokumen/' . $repositorykmwh->dokumenfilerepowh);
            }

            if ($repositorykmwh->gambarrepowh) {
                Storage::delete('public/gambar/' . $repositorykmwh->gambarrepowh);
            }

            DB::table('repositorykmwh')->where('id', $id)->delete();

            Session::flash('success', 'Repository berhasil dihapus.');
            return redirect()->route('knowledgewh.show_by_adminkmwhshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            // Ambil ID dari data yang dipilih
            $selectedIds = $request->ids;

            // Hapus data dengan ID yang dipilih
            DB::table('repositorykmwh')->whereIn('id', $selectedIds)->delete();

            // Beri respons dengan pesan sukses

            Session::flash('success', 'Item terpilih berhasil dihapus.');
            return redirect()->route('knowledgeogm.show_by_adminkmogmshow');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}
