@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Customer
                        <a href="{{ url('admin/customers/create') }}" class="btn btn-sm btn-primary float-end">New
                            Customers</a>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped " id="recent-purchases-listing">
                            <thead>
                                <tr>
                                    <th>S No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>GST No.</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customers->firstItem() + $loop->index }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->gst_no }}</td>
                                        <td>{{ $customer->description }}</td>
                                        <td>
                                            <a href="{{ url('admin/customers', $customer) }}"
                                                class="btn btn-sm btn-primary">View</a>
                                            <a href="{{ url('admin/customers/' . $customer->id . '/edit') }}"
                                                class="btn btn-sm btn-success">Edit</a>
                                            <form action="{{ url('admin/customers/' . $customer->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $customers->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
