<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumenmvp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MvpController extends Controller
{
    public function index()
    {
        return view('admin.mvp.index');
    }

    public function video()
    {
        return view('admin.mvp.video');
    }

    public function materiDokumen(Request $request)
    {
        $search = $request->input('search');

        $documents = Dokumenmvp::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.mvp.materi', compact('documents', 'search'));
    }

    public function create()
    {
        return view('admin.mvp.create');
    }

    public function edit($id)
    {
        $dokumen = Dokumenmvp::findOrFail($id);
        return view('admin.mvp.edit', compact('dokumen'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'required|url',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('dokumen_images', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        Dokumenmvp::create($validatedData);

        return redirect()->route('admin.mvp.materi')->with('success', 'Document created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $dokumen = Dokumenmvp::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($dokumen->image_path) {
                Storage::delete('public/' . $dokumen->image_path);
            }
            $imagePath = $request->file('image')->store('dokumen_images', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        $dokumen->update($validatedData);

        return redirect()->route('admin.mvp.materi')->with('success', 'Document updated successfully.');
    }

    public function destroy($id)
    {
        $dokumen = Dokumenmvp::findOrFail($id);

        if ($dokumen->image_path) {
            Storage::delete('public/' . $dokumen->image_path);
        }

        $dokumen->delete();

        return redirect()->route('admin.mvp.materi')->with('success', 'Document deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:dokumenmvp,id',
        ]);

        $documents = Dokumenmvp::whereIn('id', $request->document_ids)->get();

        foreach ($documents as $document) {
            if ($document->image_path) {
                Storage::delete('public/' . $document->image_path);
            }
            $document->delete();
        }

        return redirect()->route('admin.mvp.materi')->with('success', 'Documents deleted successfully.');
    }
}
