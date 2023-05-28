@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5> service <a href="{{ url('admin/services/create') }}" class="btn btn-sm btn-outline-primary float-end">New
                            Services</a> </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="recent-purchases-listing">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>HSN Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>{{ $services->firstItem() + $loop->index }}</td>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->price }}</td>
                                        <td>{{ $service->HSN_code }}</td>
                                        <td>
                                            <a href="{{ url('admin/services', $service) }}" class="btn btn-sm btn-outline-info">view</a>
                                            <a href="{{ url('admin/services/' . $service->id . '/edit') }}"
                                                class=" btn btn-sm btn-outline-warning">edit</a>
                                            <form method="POST" action="{{ url('admin/services/' . $service->id) }}"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class=" btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this service?')">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $services->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
