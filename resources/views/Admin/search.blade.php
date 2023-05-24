@extends('layouts.auth')

@section('content')
    <h1>Search Results</h1>

    @if($customers->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Serial Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $index => $customer)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            @foreach($customer->invoices as $invoice)
                                <a href="{{ url('admin/invoices', $invoice) }}" class="btn btn-sm btn-info">View Invoice</a>
                            @endforeach
                            @foreach($customer->quotations as $quotation)
                                <a href="{{ url('admin/quotations', $quotation) }}" class="btn btn-sm btn-info">View Quotation</a>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No results found.</p>
    @endif
@endsection
