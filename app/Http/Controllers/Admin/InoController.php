<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumenino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class InoController extends Controller
{
    public function index()
    {
        // Logic for displaying the admin MDP page
        return view('admin.ino.index');
    }

    public function video()
    {
        // Logic for displaying MDP video for admin
        return view('admin.ino.video');
    }

    public function materiDokumen(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Fetch documents with search and pagination
        $documents = Dokumenino::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->paginate(10); // Change the number to set how many items per page

        return view('admin.ino.materi', compact('documents', 'search'));
    }


    public function create(Request $request)
    {
        return view('admin.ino.create'); // Create a view for the input form
    }

    public function edit($id)
    {
        // Fetch the document by ID
        $dokumen = Dokumenino::findOrFail($id);

        // Return the view for editing the document
        return view('admin.ino.edit', compact('dokumen'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'required|url',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('dokumen_images', 'public'); // Save to public storage
            $validatedData['image_path'] = $imagePath;
        }

        // Create the document
        Dokumenino::create($validatedData);

        return redirect()->route('admin.ino.materi')->with('success', 'Document created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255', // Update validation rules
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust as needed
        ]);

        $dokumen = Dokumenino::findOrFail($id);
        $dokumen->title = $request->title; // Update to match your field names
        $dokumen->link = $request->link;

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            // Remove the old image if necessary
            if ($dokumen->image_path) {
                Storage::delete('public/dokumen_images/' . $dokumen->image_path); // Make sure the path is correct
            }

            // Store the new image
            $imagePath = $request->file('image')->store('dokumen_images', 'public');
            $dokumen->image_path = $imagePath;
        }

        $dokumen->save();

        return redirect()->route('admin.ino.materi')->with('success', 'Dokumen updated successfully!');
    }

    public function destroy($id)
    {
        Dokumenino::destroy($id);

        Session::flash('success', 'Berita berhasil dihapus.');
        return redirect()->route('admin.ino.materi')->with('success', 'Document deleted successfully.');
    }


    public function bulkDelete(Request $request)
    {
        $request->validate([
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:dokumenino,id',
        ]);

        // Delete documents and optionally their images
        foreach ($request->document_ids as $id) {
            $document = Dokumenino::find($id);
            if ($document && $document->image_path) {
                Storage::delete('public/dokumen_images/' . $document->image_path); // Delete the image file
            }
            $document->delete(); // Delete the document
        }

        return redirect()->route('admin.ino.materi')->with('success', 'Documents deleted successfully.');
    }
}