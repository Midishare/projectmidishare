<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BukupintarWh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukupintarwhController extends Controller
{
    public function index()
    {
        return view('admin.bukupintarwh.index');
    }

    public function create()
    {

        return view('admin.bukupintarwh.create');
    }

    public function materislide(Request $request)
    {


        $search = $request->input('search');

        $materiDokumen = BukuPintarWh::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->get();
        return view('admin.bukupintarwh.materi', compact('materiDokumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'files.*' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $document = new BukuPintarWh();
        $document->title = $request->title;

        if ($request->hasFile('files')) {
            $filePaths = [];
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->move(public_path('dokumen_images'), $filename);
                $filePaths[] = 'dokumen_images/' . $filename;
            }
            $document->file_paths = json_encode($filePaths);
        }

        $document->save();

        return redirect()->route('admin.bukupintarwh.materi')->with('success', 'Materi berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $materiDokumen = BukuPintarWh::findOrFail($id);
        return view('admin.bukupintarwh.edit', compact('materiDokumen'));
    }

    public function update(Request $request, $id)
    {
        $materiDokumen = BukuPintarWh::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $materiDokumen->title = $request->title;

        if ($request->hasFile('files')) {
            $filePaths = json_decode($materiDokumen->file_paths, true);

            if (!is_array($filePaths)) {
                $filePaths = [];
            }
            foreach ($filePaths as $oldPath) {
                Storage::disk('public')->delete($oldPath);
            }
            $newFilePaths = [];
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->move(public_path('dokumen_images'), $filename);

                $newFilePaths[] = 'dokumen_images/' . $filename;
            }
            $materiDokumen->file_paths = json_encode($newFilePaths);
        }
        $materiDokumen->save();

        return redirect()->route('admin.bukupintarwh.materi')->with('success', 'Slide berhasil diperbarui');
    }


    public function destroy($id)
    {
        $materiDokumen = BukuPintarWh::findOrFail($id);
        $materiDokumen->delete();
        return redirect()->route('admin.bukupintarwh.materi');
    }

    public function bulkDelete(Request $request)
    {
        $documentIds = $request->input('document_ids');

        if (!is_array($documentIds) || empty($documentIds)) {
            return redirect()->route('admin.bukupintarwh.materi');
        }

        foreach ($documentIds as $id) {
            $document = BukuPintarWh::find($id);

            if ($document) {
                $filePaths = json_decode($document->file_paths);

                if (is_array($filePaths)) {
                    foreach ($filePaths as $path) {
                        if (Storage::exists($path)) {
                            Storage::delete($path);
                        }
                    }
                }

                $document->delete();
            }
        }

        return redirect()->route('admin.bukupintarwh.materi');
    }
}
