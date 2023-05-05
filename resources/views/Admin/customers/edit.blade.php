@extends('layouts.auth')
@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Customer Details</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('admin/customers', $customer->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address">{{ $customer->address }}</textarea>
            </div>
            <div class="form-group">
                <label for="gst_no">GST No.:</label>
                <input type="text" class="form-control" id="gst_no" name="gst_no" value="{{ $customer->gst_no }}">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description">{{ $customer->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>


@endsection
