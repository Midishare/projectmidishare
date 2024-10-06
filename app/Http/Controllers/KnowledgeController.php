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
            'gambar' => 'required|image',
            'dokumenlink' => 'required|url',
        ]);

        // Handle the image upload (use event_images or other existing folder)
        if ($request->hasFile('gambar')) {
            // Change the directory to an existing folder you have, like 'event_images'
            $imagePath = $request->file('gambar')->store('gambar', 'public');
        }

        try {
            // Insert data into the 'knowledge' table
            DB::table('knowledge')->insert([
                'judul' => $request->input('judul'),
                'gambar' => $imagePath, // Store the image path in the database
                'dokumenfile' => $request->input('dokumenlink'), // Insert the document link
            ]);

            return redirect()->route('knowledge.show')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
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
            'dokumenfile' => 'required|url', // Validate as a URL instead of file
        ]);

        $id = $request->id;

        $repositorykm = DB::table('repositorykm')->where('id', $id)->first();
        $gambarLama = $repositorykm->gambar;

        try {
            $updateData = [
                'judul' => $request->input('judul'),
                'dokumenfile' => $request->input('dokumenfile'), // Update the link
            ];

            if ($request->hasFile('gambar')) {
                // Store new image file
                $gambarPath = $request->file('gambar')->store('public/gambar');
                $gambarNama = basename($gambarPath);
                $updateData['gambar'] = $gambarNama;

                // Delete the old image
                Storage::delete('public/gambar/' . $gambarLama);
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
        Session::flash('success', 'Repository berhasil dihapus.');
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
