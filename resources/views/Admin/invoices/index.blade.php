@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5>Invoice
                        <a href="{{ url('admin/invoices/create') }}" class="btn btn-sm btn-primary float-end">New
                            Invoice</a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped "  id="recent-purchases-listing">
                            <thead>
                                <tr>
                                    <th>S No</th>
                                    <th>Customer Name</th>
                                    <th>Issue Date</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoices->firstItem() + $loop->index }}</td>
                                        <td>{{ $invoice->customer->name }}</td>
                                        <td>{{ $invoice->created_at }}</td>
                                        <td>
                                            @php
                                                $totalQuantity = 0;
                                                foreach ($invoice->invoiceItems as $invoiceItem) {
                                                    $totalQuantity += $invoiceItem->quantity;
                                                }
                                                echo $totalQuantity;
                                            @endphp
                                        </td>
                                        <td>{{ $invoice->total_amount }}</td>
                                        <td style="color: {{ $invoice->payment_status == 1 ? 'green' : 'red' }};">
                                            @if ($invoice->payment_status == 1)
                                                successfull
                                            @else
                                                due
                                            @endif

                                        </td>
                                        <td>
                                            @if (!$invoice->payment_status)
                                                <a
                                                    href="{{ url('admin/invoices/' . $invoice->id . '/payment') }}"class="btn btn-sm btn-success">Payment</a>
                                                <a
                                                    href="{{ url('admin/invoices', $invoice) }}"class="btn btn-sm btn-info">View</a>
                                                <a
                                                    href="{{ url('admin/invoices/' . $invoice->id . '/edit') }}"class="btn btn-sm btn-primary">Edit</a>
                                            @else
                                                <a href="{{ url('admin/invoices', $invoice) }}"
                                                    class="btn btn-sm btn-info">View</a>
                                            @endif
                                            <form action="{{ url('admin/invoices', $invoice) }}" method="POST"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this invoice?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $invoices->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
