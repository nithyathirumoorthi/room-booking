@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Rooms</h5>
                    <p class="card-text fs-3">{{ $totalRooms }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Available Rooms</h5>
                    <p class="card-text fs-3">{{ $availableRooms }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Booked Rooms</h5>
                    <p class="card-text fs-3">{{ $bookedRooms }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h5 class="card-title">Total Bookings</h5>
                    <p class="card-text fs-3">{{ $totalBookings }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
