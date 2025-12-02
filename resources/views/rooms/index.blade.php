@extends('layouts.app')
@section('title', 'Available Rooms')

@section('content')
<div class="container">
    <h1 class="mb-4">Available Rooms</h1>
    <div class="row">
        @foreach($rooms as $room)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }} ({{ $room->type }})</h5>
                    <p class="card-text">Price: ₹{{ number_format($room->price, 2) }}</p>
                    <p><strong>Status:</strong> {{ $room->is_available ? 'Available' : 'Unavailable' }}</p>
                    <a href="{{ route('rooms.show', $room) }}" class="btn btn-primary btn-sm">Details</a>
                    @if($room->is_available == 1)
                    <a href="{{ route('book.room', $room) }}" class="btn btn-success btn-sm">Book Now</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-3">
        {{ $rooms->links() }}
    </div>
</div>
@endsection
