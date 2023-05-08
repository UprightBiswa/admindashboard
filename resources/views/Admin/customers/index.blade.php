@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 offset-md-0">
                <div class="card">
                    <div class="card-header"
                        style="text-align: center;
                        height: 70px;
                        background: -webkit-linear-gradient(left, #a200ff, #c51111);
                        color: #fff;
                        font-weight: bold;
                        line-height: 80px;">
                        <h1>Customer</h1>
                    </div>
                    <div class="card shadow m-4 ">
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>GST No.</th>
                                            <th>Description</th>
                                            <th><a href="{{ url('admin/customers/create') }}"
                                                    class="btn btn-sm btn-primary mb-3 ">New Customers</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as  $index =>$customer)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
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
                                                    <form action="{{ url('admin/customers/' . $customer->id) }}"
                                                        method="POST" class="d-inline">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
