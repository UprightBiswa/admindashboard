@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Customer Details
                    <a href="{{ url('admin/customers') }}" class="btn btn-sm btn-primary float-end">BACK</a>
                </h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Name:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $customer->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $customer->email }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Phone:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $customer->phone }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Address:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $customer->address }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>GST No.:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $customer->gst_no }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Description:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $customer->description }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Created At:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $customer->created_at }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Updated At:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $customer->updated_at }}
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ url('admin/customers/' . $customer->id . '/edit') }}" class="btn btn-sm btn-success">Edit</a>
                <form action="{{ url('admin/customers/' . $customer->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
