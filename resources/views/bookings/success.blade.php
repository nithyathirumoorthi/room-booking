@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Payment Successful 🎉</h2>
    <p>Your booking ID: <strong>#{{ $booking->id }}</strong></p>
    <p>Status: <strong>{{ ucfirst($booking->payment_status) }}</strong></p>

    <a href="{{ route('bookings.index') }}" class="btn btn-success mt-3">My Bookings</a>
</div>
@endsection
