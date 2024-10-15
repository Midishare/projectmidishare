<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumenIp; // Make sure you are using the correct model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class IpController extends Controller
{
    public function index()
    {
        return view('admin.ip.index');
    }

    public function materiDokumen(Request $request)
    {
        $search = $request->input('search');
        $documents = DokumenIp::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('admin.ip.materi', compact('documents', 'search'));
    }

    public function create(Request $request)
    {
        return view('admin.ip.create');
    }

    public function store(Request $request)
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

        DokumenIp::create($validatedData);

        return redirect()->route('admin.ip.materi')->with('success', 'Document created successfully.');
    }

    public function edit($id)
    {
        $document = DokumenIp::findOrFail($id);
        return view('admin.ip.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|in:Business Controlling,Corporate Audit,Finance,IT,Merchandising,Marketing,Operation,Property Development,Service Quality,Corporate Legal & Compliance',
        ]);

        $document = DokumenIp::findOrFail($id);
        $document->title = $request->title;
        $document->link = $request->link;
        $document->category = $request->category;

        if ($request->hasFile('image')) {
            if ($document->image_path) {
                Storage::delete('public/dokumen_images/' . $document->image_path);
            }

            $imagePath = $request->file('image')->store('dokumen_images', 'public');
            $document->image_path = $imagePath;
        }

        $document->save();

        return redirect()->route('admin.ip.materi')->with('success', 'Document updated successfully!');
    }

    public function destroy($id)
    {
        $document = DokumenIp::findOrFail($id);
        if ($document->image_path) {
            Storage::delete('public/dokumen_images/' . $document->image_path);
        }
        $document->delete();

        return redirect()->route('admin.ip.materi')->with('success', 'Document deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:dokumenip,id',
        ]);

        foreach ($request->document_ids as $id) {
            $document = DokumenIp::find($id);
            if ($document && $document->image_path) {
                Storage::delete('public/dokumen_images/' . $document->image_path);
            }
            $document->delete();
        }

        return redirect()->route('admin.ip.materi')->with('success', 'Documents deleted successfully.');
    }
}
