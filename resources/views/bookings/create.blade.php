@extends('layouts.app')
@section('title', 'Book ' . $room->name)

@section('content')
<div class="container">
    <h2>Book Room: {{ $room->name }}</h2>

    @guest
        <div class="alert alert-info">
            You can book as guest OR  
            <a href="{{ route('login') }}">Login</a> / 
            <a href="{{ route('register') }}">Register</a> to track bookings.
        </div>
    @endguest

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('book.store', $room) }}">
        @csrf
        
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="customer_name" class="form-control"
                value="{{ old('customer_name', auth()->user()->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="customer_email" class="form-control"
                value="{{ old('customer_email', auth()->user()->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Check-in Date</label>
            <input type="date" name="from_date" class="form-control"
                value="{{ old('from_date') }}" required>
        </div>

        <div class="mb-3">
            <label>Check-out Date</label>
            <input type="date" name="to_date" class="form-control"
                value="{{ old('to_date') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
    </form>
</div>
@endsection
