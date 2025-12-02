@extends('layouts.app')
@section('title', 'My Bookings')

@section('content')
<div class="container">
    <h2>My Bookings</h2>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Room</th>
                <th>From</th>
                <th>To</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->room->name }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->from_date)->format('d M, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->to_date)->format('d M, Y') }}</td>
                <td>${{ $booking->total_price }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td><a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-primary">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $bookings->links() }}
</div>
@endsection
