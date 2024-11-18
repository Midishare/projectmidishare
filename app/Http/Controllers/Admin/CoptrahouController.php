<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coptrahou;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CoptrahouController extends Controller
{
    public function index()
    {
        return view('admin.coptrahou.index');
    }

    public function video()
    {
        return view('admin.coptrahou.video');
    }

    public function materiDokumen(Request $request)
    {
        $search = $request->input('search');

        $documents = Coptrahou::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.coptrahou.materi', compact('documents', 'search'));
    }

    public function create(Request $request)
    {
        return view('admin.coptrahou.create');
    }

    public function edit($id)
    {
        $dokumen = Coptrahou::findOrFail($id);
        return view('admin.coptrahou.edit', compact('dokumen'));
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

        Coptrahou::create($validatedData);

        return redirect()->route('admin.coptrahou.materi')->with('success', 'Document created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $dokumen = Coptrahou::findOrFail($id);
        $dokumen->title = $request->title;
        $dokumen->link = $request->link;

        if ($request->hasFile('image')) {
            if ($dokumen->image_path) {
                Storage::delete('public/dokumen_images/' . $dokumen->image_path);
            }

            $imagePath = $request->file('image')->store('dokumen_images', 'public');
            $dokumen->image_path = $imagePath;
        }

        $dokumen->save();

        return redirect()->route('admin.coptrahou.materi')->with('success', 'Dokumen updated successfully!');
    }

    public function destroy($id)
    {
        Coptrahou::destroy($id);

        Session::flash('success', 'Document deleted successfully.');
        return redirect()->route('admin.coptrahou.materi')->with('success', 'Document deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:coptrahou,id',
        ]);

        foreach ($request->document_ids as $id) {
            $document = Coptrahou::find($id);
            if ($document && $document->image_path) {
                Storage::delete('public/dokumen_images/' . $document->image_path);
            }
            $document->delete();
        }

        return redirect()->route('admin.coptrahou.materi')->with('success', 'Documents deleted successfully.');
    }
}
