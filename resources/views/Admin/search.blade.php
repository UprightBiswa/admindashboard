@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Search Results
                        <a href="{{ url('admin/dashboard') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                    </h5>
                </div>
                <div class="card-body">
                    @if ($customers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $index => $customer)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>
                                                @foreach ($customer->invoices as $invoice)
                                                    <a href="{{ url('admin/invoices', $invoice) }}"
                                                        class="btn btn-sm btn-info">View Invoice</a>
                                                @endforeach
                                                @foreach ($customer->quotations as $quotation)
                                                    <a href="{{ url('admin/quotations', $quotation) }}"
                                                        class="btn btn-sm btn-info">View Quotation</a>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No results found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
