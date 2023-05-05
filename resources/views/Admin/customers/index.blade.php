@extends('layouts.auth')

@section('content')
<div class="row">
    <div class="col-sm-9"><h5 >All Customers Details</h5></div>
    <div class="col-sm-2" ><a href="{{ url('admin/customers/create') }}" class="btn btn-sm btn-primary mb-3 ">New Customers</a></div>
</div>
    <div class="card">
        <div class="card-header">Customers</div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
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
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->gst_no }}</td>
                            <td>{{ $customer->description }}</td>
                            <td>
                                <a href="{{ url('admin/customers', $customer) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ url('admin/customers/'.$customer->id.'/edit') }}" class="btn btn-sm btn-success">Edit</a>
                                <form action="{{ url('admin/customers/'.$customer->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

