@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Rooms</h1>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary mb-3">Add Room</a>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Available</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rooms as $room)
            <tr>
                <td>{{ $room->name }}</td>
                <td>{{ ucfirst($room->type) }}</td>
                <td>{{ $room->price }}</td>
                <td>{{ $room->is_available ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $rooms->links() }}
</div>
@endsection
