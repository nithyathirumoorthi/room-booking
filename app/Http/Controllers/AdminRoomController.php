<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class AdminRoomController extends Controller
{
    // List all rooms (Admin)
    public function index()
    {
        $rooms = Room::paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    // Show create form
    public function create()
    {
        return view('admin.rooms.create');
    }

    // Store room
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:single,double,suite',
            'price' => 'required|numeric|min:0',
        ]);

        $data['is_available'] = $request->has('is_available');

        Room::create($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully!');
    }

    // Show edit form
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    // Update room
    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:single,double,suite',
            'price' => 'required|numeric|min:0',
        ]);

        $data['is_available'] = $request->has('is_available');

        $room->update($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully!');
    }

    // Delete room
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully!');
    }
}
