<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Carbon\Carbon;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::where('customer_email', auth()->user()->email ?? null)
                        ->orderBy('id', 'desc')
                        ->paginate(10);

       return view('bookings.index', compact('bookings'));
    }
    // Show Booking Form
    public function create(Room $room)
    {
        return view('bookings.create', compact('room'));
    }

    // Store booking + redirect to Stripe
    public function store(Request $request, Room $room)
    {
        $data = $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'from_date'      => 'required|date|after_or_equal:today',
            'to_date'        => 'required|date|after_or_equal:from_date',
        ]);

        // Calculate days
        $from = Carbon::parse($data['from_date']);
        $to   = Carbon::parse($data['to_date']);

        // Difference in days, inclusive of both start and end date
        $days = $from->diffInDays($to) + 1;
        $total = $days * $room->price;

        // Create booking with "pending"
        $booking = Booking::create([
            'user_id'        => auth()->id(), // guest will be null
            'room_id'        => $room->id,
            'from_date'      => $data['from_date'],
            'to_date'        => $data['to_date'],
            'total_price'    => $total,
            'status'         => 'booked',
            'customer_name'  => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'payment_status' => 'pending',
        ]);

        // Stripe Checkout
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $data['customer_email'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                        'name' => "Room Booking: {$room->name}"
                    ],
                    'unit_amount' => $total * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('booking.success', $booking->id),
            'cancel_url' => route('booking.cancel', $booking->id),
        ]);

        return redirect($session->url);
    }
    // Show booking details
    public function show(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }
        return view('bookings.show', compact('booking'));
    }
    // Payment Success
    public function success($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'payment_status' => 'paid',
        ]);

        return view('bookings.success', compact('booking'));
    }

    // Payment Cancel
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'payment_status' => 'failed',
        ]);

        return view('bookings.failed', compact('booking'));
    }
}
