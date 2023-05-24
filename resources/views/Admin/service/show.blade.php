@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Service Details
                    <a href="{{ url('admin/services') }}" class="btn btn-sm btn-primary float-end">BACK</a>
                </h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Name:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $service->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Price:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $service->price }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>HSN Code:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $service->HSN_code }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Tax rate(%):</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $service->tax_rate }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Description:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $service->description }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <strong>Created At:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $service->created_at }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Updated At:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $service->updated_at }}
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ url('admin/services/' . $service->id . '/edit') }}" class="btn btn-sm btn-success">Edit</a>
                <form action="{{ url('admin/services/' . $service->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
