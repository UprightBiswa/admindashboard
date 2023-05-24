@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Quotation
                        <a href="{{ url('admin/quotations/create') }}" class="btn btn-sm btn-primary float-end">New
                            Quotaion</a>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>S No</th>
                                    <th>Customer Name</th>
                                    <th>Issue Date</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quotations as $quotation)
                                    <tr>
                                        <td>{{ $quotations->firstItem() + $loop->index }}</td>
                                        <td>{{ $quotation->customer->name }}</td>
                                        <td>{{ $quotation->created_at }}</td>
                                        <td>
                                            @php
                                                $totalQuantity = 0;
                                                foreach ($quotation->quotationItems as $quotationItem) {
                                                    $totalQuantity += $quotationItem->quantity;
                                                }
                                                echo $totalQuantity;
                                            @endphp
                                        </td>
                                        <td>{{ $quotation->total_amount }}</td>
                                        <td>
                                            <a href="{{ url('admin/quotations', $quotation) }}"
                                                class="btn btn-sm btn-info">View</a>
                                            <a href="{{ url('admin/quotations/' . $quotation->id . '/edit') }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ url('admin/quotations', $quotation) }}" method="POST"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this quotation?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $quotations->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
