@extends('layouts.auth')

@section('content')
  {{-- <h1>Quotaton</h1>
  <div class="card-header">
    <h3>Quotation
        <a href="{{ url('admin/quotations/create') }}" class="btn btn-primary btn-sm text-white float-end">Add Quotation</a>
    </h3>
</div> --}}
{{-- <h1>Quotations</h1>
    <a href="{{ url('admin/quotations/create') }}" class="btn btn-primary">New Quotation</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotations as $quotation)
                <tr>
                    <td>{{ $quotation->customer->name }}</td>
                    <td>{{ $quotation->created_at }}</td>
                    <td>
                        <a href="{{ url('admin/quotations.show', $quotation) }}" class="btn btn-primary">View</a>
                        <a href="{{ url('admin/quotations.edit', $quotation) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ url('admin/quotations.destroy', $quotation) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
    <h1>Quotations</h1>
    <a href="{{ url('admin/quotations/create') }}" class="btn btn-primary">New Quotation</a>
    <div class="container">
        <h1>Quotations</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Total Rate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotations as $quotation )
                    <tr>
                        <td>{{ $quotation->customer->name }}</td>
                        <td>{{ $quotation->created_at }}</td>
                        <td>
                            @foreach($quotation->quotationItems as $quotationItem)
                            {{ $quotationItem->amount }}
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ url('admin/quotations', $quotation) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ url('admin/quotations/edit', $quotation) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ url('admin/quotations', $quotation) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this quotation?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  @endsection
