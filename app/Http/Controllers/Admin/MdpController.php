<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumenmdp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MdpController extends Controller
{
    public function index()
    {
        return view('admin.mdp.index');
    }

    public function video()
    {
        return view('admin.mdp.video');
    }

    public function materiDokumen(Request $request)
    {
        $search = $request->input('search');

        $documents = Dokumenmdp::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.mdp.materi', compact('documents', 'search'));
    }

    public function create()
    {
        return view('admin.mdp.create');
    }

    public function edit($id)
    {
        $dokumen = Dokumenmdp::findOrFail($id);
        return view('admin.mdp.edit', compact('dokumen'));
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

        Dokumenmdp::create($validatedData);

        return redirect()->route('admin.mdp.materi')->with('success', 'Document created successfully.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|in:Business Controlling,Corporate Audit,Finance,IT,Merchandising,Marketing,Operation,Property Development,Service Quality,Corporate Legal & Compliance',
        ]);

        $dokumen = Dokumenmdp::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($dokumen->image_path) {
                Storage::delete('public/' . $dokumen->image_path);
            }
            $imagePath = $request->file('image')->store('dokumen_images', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        $dokumen->update($validatedData);

        return redirect()->route('admin.mdp.materi')->with('success', 'Document updated successfully.');
    }

    public function destroy($id)
    {
        $dokumen = Dokumenmdp::findOrFail($id);

        if ($dokumen->image_path) {
            Storage::delete('public/' . $dokumen->image_path);
        }

        $dokumen->delete();

        return redirect()->route('admin.mdp.materi')->with('success', 'Document deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:dokumenmdp,id',
        ]);

        $documents = Dokumenmdp::whereIn('id', $request->document_ids)->get();

        foreach ($documents as $document) {
            if ($document->image_path) {
                Storage::delete('public/' . $document->image_path);
            }
            $document->delete();
        }

        return redirect()->route('admin.mdp.materi')->with('success', 'Documents deleted successfully.');
    }
}
