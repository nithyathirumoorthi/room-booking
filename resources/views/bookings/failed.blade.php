@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Payment Failed ❌</h2>
    <p>You can try again anytime.</p>

    <a href="{{ route('rooms.index') }}" class="btn btn-danger mt-3">Back to Rooms</a>
</div>
@endsection
