<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumendp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DpController extends Controller
{
    public function index()
    {
        return view('admin.dp.index');
    }

    public function video()
    {
        return view('admin.dp.video');
    }

    public function materiDokumen(Request $request)
    {
        $search = $request->input('search');
        $documents = Dokumendp::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.dp.materi', compact('documents', 'search'));
    }

    public function create(Request $request)
    {
        return view('admin.dp.create');
    }

    public function edit($id)
    {
        $dokumen = Dokumendp::findOrFail($id);
        return view('admin.dp.edit', compact('dokumen'));
    }

    public function storeDokumen(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'required|url',
            'category' => 'required|in:Business Controlling,Corporate Audit,Finance,IT,Merchandising,Marketing,Operation,Property Development,Service Quality,Corporate Legal & Compliance',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('dokumen_images', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        Dokumendp::create($validatedData);
        return redirect()->route('admin.dp.materi')->with('success', 'Document created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|in:Business Controlling,Corporate Audit,Finance,IT,Merchandising,Marketing,Operation,Property Development,Service Quality,Corporate Legal & Compliance',
        ]);

        $dokumen = Dokumendp::findOrFail($id);
        $dokumen->title = $request->title;
        $dokumen->link = $request->link;
        $dokumen->category = $request->category;

        if ($request->hasFile('image')) {
            if ($dokumen->image_path) {
                Storage::delete('public/dokumen_images/' . $dokumen->image_path);
            }

            $imagePath = $request->file('image')->store('dokumen_images', 'public');
            $dokumen->image_path = $imagePath;
        }

        $dokumen->save();
        return redirect()->route('admin.dp.materi')->with('success', 'Dokumen updated successfully!');
    }

    public function destroy($id)
    {
        Dokumendp::destroy($id);
        Session::flash('success', 'Berita berhasil dihapus.');
        return redirect()->route('admin.dp.materi')->with('success', 'Document deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:dokumendp,id',
        ]);

        foreach ($request->document_ids as $id) {
            $document = Dokumendp::find($id);
            if ($document && $document->image_path) {
                Storage::delete('public/dokumen_images/' . $document->image_path);
            }
            $document->delete();
        }

        return redirect()->route('admin.dp.materi')->with('success', 'Documents DP deleted successfully.');
    }
}
