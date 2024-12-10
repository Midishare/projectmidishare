<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BukuPintarWh;
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

    public function materislide()
    {
        $materiDokumen = BukuPintarWh::all();
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
            foreach ($materiDokumen->file_paths as $oldPath) {
                Storage::disk('public')->delete($oldPath);
            }

            $filePaths = [];
            foreach ($request->file('files') as $file) {
                $path = $file->store('images', 'public');
                $filePaths[] = $path;
            }
            $materiDokumen->file_paths = $filePaths;
        }

        $materiDokumen->save();

        return redirect()->route('admin.bukupintarwh.materi')
            ->with('success', 'Slide berhasil diperbarui');
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
                foreach ($document->file_paths as $path) {
                    if (Storage::exists($path)) {
                        Storage::delete($path);
                    }
                }
                $document->delete();
            }
        }

        return redirect()->route('admin.bukupintarwh.materi');
    }
}
