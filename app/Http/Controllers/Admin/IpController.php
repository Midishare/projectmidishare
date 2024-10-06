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
        // Logic for displaying the admin IP page
        return view('admin.ip.index');
    }

    public function materiDokumen(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Fetch documents with search and pagination
        $documents = DokumenIp::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->paginate(10); // Change the number to set how many items per page

        return view('admin.ip.materi', compact('documents', 'search'));
    }

    public function create(Request $request)
    {
        return view('admin.ip.create'); // Create a view for the input form
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
        DokumenIp::create($validatedData);

        return redirect()->route('admin.ip.materi')->with('success', 'Document created successfully.');
    }

    public function edit($id)
    {
        // Fetch the document by ID
        $document = DokumenIp::findOrFail($id);

        // Return the view for editing the document
        return view('admin.ip.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255', // Update validation rules
            'link' => 'required|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust as needed
        ]);

        $document = DokumenIp::findOrFail($id);
        $document->title = $request->title; // Update to match your field names
        $document->link = $request->link;

        // Handle image upload if a new one is provided
        if ($request->hasFile('image')) {
            // Remove the old image if necessary
            if ($document->image_path) {
                Storage::delete('public/dokumen_images/' . $document->image_path); // Make sure the path is correct
            }

            // Store the new image
            $imagePath = $request->file('image')->store('dokumen_images', 'public');
            $document->image_path = $imagePath;
        }

        $document->save();

        return redirect()->route('admin.ip.materi')->with('success', 'Document updated successfully!');
    }

    public function destroy($id)
    {
        $document = DokumenIp::findOrFail($id);
        // Remove the image if it exists
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
            'document_ids.*' => 'exists:dokumenip,id', // Ensure the correct table name is used
        ]);

        // Delete documents and optionally their images
        foreach ($request->document_ids as $id) {
            $document = DokumenIp::find($id);
            if ($document && $document->image_path) {
                Storage::delete('public/dokumen_images/' . $document->image_path); // Delete the image file
            }
            $document->delete(); // Delete the document
        }

        return redirect()->route('admin.ip.materi')->with('success', 'Documents deleted successfully.');
    }
}
