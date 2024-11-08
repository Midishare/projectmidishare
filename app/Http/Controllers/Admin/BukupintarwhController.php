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
            'files.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filePaths = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('dokumen_images', 'public');
                $filePaths[] = $path;
            }
        }

        BukuPintarWh::create([
            'title' => $request->input('title'),
            'file_paths' => $filePaths,
        ]);

        return redirect()->route('admin.bukupintarwh.index')->with('success', 'Slide created successfully');
    }

    public function edit($id)  // Modified to use $id parameter
    {
        $materiDokumen = BukuPintarWh::findOrFail($id);
        return view('admin.bukupintarwh.edit', compact('materiDokumen'));
    }

    public function update(Request $request, $id)  // Modified to use $id parameter
    {
        $materiDokumen = BukuPintarWh::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $materiDokumen->title = $request->title;

        if ($request->hasFile('files')) {
            // Delete old images
            foreach ($materiDokumen->file_paths as $oldPath) {
                Storage::disk('public')->delete($oldPath);
            }

            // Upload new images and save their paths
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

    public function destroy($id)  // Modified to use $id parameter
    {
        $materiDokumen = BukuPintarWh::findOrFail($id);
        $materiDokumen->delete();
        return redirect()->route('admin.bukupintarwh.materi');
    }

    public function bulkDelete(Request $request)
    {
        BukuPintarWh::whereIn('id', $request->ids)->delete();
        return redirect()->route('admin.bukupintarwh.materi');
    }
}
