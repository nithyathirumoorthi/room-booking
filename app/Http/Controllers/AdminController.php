<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class AdminController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count();
        $availableRooms = Room::where('is_available', true)->count();
        $bookedRooms = Room::where('is_available', false)->count();
        $totalBookings = Booking::count();

        return view('admin.dashboard', compact(
            'totalRooms',
            'availableRooms',
            'bookedRooms',
            'totalBookings'
        ));
    }
}
