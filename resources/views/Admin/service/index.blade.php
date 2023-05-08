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
                        <h1>Service</h1>
                    </div>
                    <div class="card shadow m-4 ">
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>HSN Code</th>
                                            <th><a href="{{ url('admin/services/create') }}" class="btn btn-primary">Create
                                                    Service</a></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>HSN Code</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($services as $index => $service)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $service->name }}</td>
                                                <td>{{ $service->price }}</td>
                                                <td>{{ $service->HSN_code }}</td>
                                                <td>
                                                    <a href="{{ url('admin/services', $service) }}"
                                                        class="btn btn-sm btn-primary">View</a>
                                                    <a href="{{ url('admin/services/' . $service->id . '/edit') }}"
                                                        class="btn btn-sm btn-success">Edit</a>
                                                    <form method="POST"
                                                        action="{{ url('admin/services/' . $service->id) }}"
                                                        class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
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
