@extends('layouts.app')
@section('title', 'Booking #' . $booking->id)

@section('content')
<div class="container">
    <h2>Booking Details</h2>
     <a href="{{ route('rooms.index') }}" class="btn btn-secondary mb-3">← Back to Rooms</a>

    <table class="table table-bordered">
        <tr><th>Room</th><td>{{ $booking->room->name }}</td></tr>
        <tr><th>From</th><td>{{ \Carbon\Carbon::parse($booking->from_date)->format('d M, Y') }}</td></tr>
        <tr><th>To</th><td>{{ \Carbon\Carbon::parse($booking->to_date)->format('d M, Y') }}</td></tr>
        <tr><th>Total Price</th><td>${{ $booking->total_price }}</td></tr>
        <tr><th>Status</th><td>{{ ucfirst($booking->status) }}</td></tr>
    </table>   
</div>
@endsection
