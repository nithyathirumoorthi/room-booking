@extends('layouts.app')
@section('title', $room->name)

@section('content')
<div class="container">
    <h2>{{ $room->name }} Details</h2>
    <p><strong>Type:</strong> {{ $room->type }}</p>
    <p><strong>Price:</strong> ₹{{ number_format($room->price, 2) }}</p>
    <p><strong>Status:</strong> {{ $room->is_available ? 'Available' : 'Unavailable' }}</p>
    @if($room->is_available == 1)
        <a href="{{ route('book.room', $room) }}" class="btn btn-success">Book Now</a>
    @else
        <button class="btn btn-secondary" disabled>Unavailable</button>
    @endif
</div>
@endsection
