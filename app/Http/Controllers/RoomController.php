<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    // List all rooms (User)
    public function index()
    {
        $rooms = Room::paginate(10);
        return view('rooms.index', compact('rooms'));
    }
    // Show single room details
    public function show(Room $room)
    {
        // $room is automatically injected via route-model binding
        return view('rooms.show', compact('room'));
    }
  
}
