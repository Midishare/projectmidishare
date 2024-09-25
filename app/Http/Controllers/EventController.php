<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Show all events (for users)
    public function showAll()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    // Show a specific event (for users)
    // Show a specific event (for users)
    // Show a specific event (for users)
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event')); // Corrected
    }



    // Show the admin page with all events
    public function index()
    {
        $events = Event::paginate(10); // Adjust the number of items per page as needed
        return view('events.index', compact('events'));
    }


    // Show the form to create an event
    public function create()
    {
        return view('events.create');
    }

    // Store the event posted by the admin
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            // Store the image and get the filename only
            $imagePath = $request->file('image')->store('event_images', 'public');
            $imageName = basename($imagePath); // Get only the filename
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName, // Save only the filename
        ]);

        return redirect()->route('events.admin')->with('success', 'Event created successfully.');
    }

    public function edit($id)
    {
        // Find the event by its ID
        $event = Event::findOrFail($id);

        // Return the view for editing the event and pass the event data
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        // Find the event by its ID
        $event = Event::findOrFail($id);

        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update the event details
        $event->title = $request->title;
        $event->description = $request->description;

        // Handle the image upload if there's a new image
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($event->image && Storage::exists('public/event_images/' . $event->image)) {
                Storage::delete('public/event_images/' . $event->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('public/event_images');
            $event->image = basename($imagePath);
        }

        // Save the updated event
        $event->save();

        // Redirect back to the events list or wherever you want
        return redirect()->route('events.admin')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Optionally, delete the image file from storage
        if ($event->image) {
            Storage::disk('public')->delete('event_images/' . $event->image);
        }

        $event->delete();

        return redirect()->route('events.admin')->with('success', 'Event deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->back()->withErrors(['error' => 'Tidak ada event yang dipilih.']);
        }

        try {
            Event::destroy($ids); // Delete the events by their IDs
            return redirect()->route('events.admin')->with('success', 'Event berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus event.']);
        }
    }
}
