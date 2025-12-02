@extends('layouts.admin')
@section('title', 'Admin Bookings')

@section('content')
<div class="container">
    <h2 class="mb-3">All Bookings</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Room</th>
                <th>User</th>
                <th>Email</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
            <tr>
                <td>{{ $b->id }}</td>
                <td>{{ $b->room->name ?? 'N/A' }}</td>
                <td>{{ $b->customer_name ?? 'N/A' }}</td>
                <td>{{ $b->customer_email ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($b->from_date)->format('d M, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($b->to_date)->format('d M, Y') }}</td>
                <td>₹{{ number_format($b->total_price, 2) }}</td>
                <td>
                    @if($b->status === 'booked')
                        <span class="badge bg-primary">{{ ucfirst($b->status) }}</span>
                    @elseif($b->status === 'completed')
                        <span class="badge bg-success">{{ ucfirst($b->status) }}</span>
                    @elseif($b->status === 'cancelled')
                        <span class="badge bg-danger">{{ ucfirst($b->status) }}</span>
                    @endif
                </td>
                <td>
                    <form method="POST" action="{{ route('admin.bookings.updateStatus', $b) }}">
                        @csrf
                        <select name="status" class="form-select form-select-sm mb-1">
                            <option value="booked" {{ $b->status=='booked'?'selected':'' }}>Booked</option>
                            <option value="completed" {{ $b->status=='completed'?'selected':'' }}>Completed</option>
                            <option value="cancelled" {{ $b->status=='cancelled'?'selected':'' }}>Cancelled</option>
                        </select>
                        <button class="btn btn-sm btn-primary w-100">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $bookings->links() }}
</div>
@endsection
