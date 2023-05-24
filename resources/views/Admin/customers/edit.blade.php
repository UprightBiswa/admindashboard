@extends('layouts.auth')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Customer Details <a href="{{ url('admin/customers') }}"
                            class="btn btn-danger btn-sm text-white float-end">BACK</a></h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('admin/customers', $customer->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $customer->name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $customer->email }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ $customer->phone }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="gst_no">GST No.:</label>
                                <input type="text" class="form-control" id="gst_no" name="gst_no"
                                    value="{{ $customer->gst_no }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address">Address:</label>
                                <textarea class="form-control" id="address" name="address">{{ $customer->address }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description">{{ $customer->description }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
