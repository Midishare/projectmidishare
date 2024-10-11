<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // Show all events (for users)
    public function showAll(Request $request)
    {
        $search = $request->input('search');

        $events = Event::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->paginate(6);

        return view('events', compact('events'));
    }

    public function show(Request $request)
    {
        $search = $request->input('search');

        $events = Event::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->orderBy('id', 'desc')->paginate(6);

        return view('events', compact('events'));
    }

    public function detail($id)
    {
        $event = Event::find($id); 
        if (!$event) {
            return redirect()->route('events.show')->with('error', 'Event not found.');
        }
        return view('event_detail', ['event' => $event]);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $events = Event::when($search, function ($query) use ($search) {
            return $query->where('title', 'like', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->paginate(10); 

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('event_images', 'public');
            $imageName = basename($imagePath);
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName, 
        ]);

        return redirect()->route('events.admin')->with('success', 'Event created successfully.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $event->title = $request->title;
        $event->description = $request->description;

        if ($request->hasFile('image')) {
            if ($event->image && Storage::exists('public/event_images/' . $event->image)) {
                Storage::delete('public/event_images/' . $event->image);
            }
            $imagePath = $request->file('image')->store('public/event_images');
            $event->image = basename($imagePath);
        }
        $event->save();

        return redirect()->route('events.admin')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
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
            Event::destroy($ids);
            return redirect()->route('events.admin')->with('success', 'Event berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus event.']);
        }
    }
}
