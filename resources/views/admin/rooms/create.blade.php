@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{ isset($room) ? 'Edit Room' : 'Add Room' }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ isset($room) ? route('admin.rooms.update',$room) : route('admin.rooms.store') }}" method="POST">
        @csrf
        @if(isset($room)) @method('PUT') @endif

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name',$room->name ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control">
                <option value="single" {{ (old('type',$room->type ?? '')=='single')?'selected':'' }}>Single</option>
                <option value="double" {{ (old('type',$room->type ?? '')=='double')?'selected':'' }}>Double</option>
                <option value="suite" {{ (old('type',$room->type ?? '')=='suite')?'selected':'' }}>Suite</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ old('price',$room->price ?? '') }}">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_available" class="form-check-input" {{ (old('is_available',$room->is_available ?? false))?'checked':'' }}>
            <label class="form-check-label">Available</label>
        </div>

        <button class="btn btn-success">{{ isset($room) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
