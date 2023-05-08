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
                        <h1>Invoice</h1>
                    </div>
                    <div class="card shadow m-4 ">
                        <div class="card-body">
                            <div class="table-responsive ">
                                <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S No</th>
                                            <th>Customer Name</th>
                                            <th>Issue Date</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th> <a href="{{ url('admin/invoices/create') }}"
                                                    class="btn btn-sm btn-primary mb-3 ">New Invoices</a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $index => $invoice)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
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
                                                        <button type="button" class="btn btn-sm btn-success"
                                                            data-toggle="modal"
                                                            data-target="#paymentModal{{ $invoice->id }}">
                                                            Payment
                                                        </button>
                                                    @endif
                                                    <a href="{{ url('admin/invoices', $invoice) }}"
                                                        class="btn btn-sm btn-info">View</a>
                                                    <a href="{{ url('admin/invoices/' . $invoice->id . '/edit') }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <form action="{{ url('admin/invoices', $invoice) }}" method="POST"
                                                        style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this invoice?')">Delete</button>
                                                    </form>

                                                </td>
                                            </tr>
                                            <div class="modal fade" id="paymentModal{{ $invoice->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="paymentModal{{ $invoice->id }}Label"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="paymentModal{{ $invoice->id }}Label">
                                                                Payment for Invoice #{{ $invoice->id }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('admin/invoices/' . $invoice->id . '/payment') }}" method="POST" id="paymentForm">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="payment_method">Payment Method</label>
                                                                    <select class="form-control" id="payment_method" name="payment_method" required>
                                                                        <option value="">Select Payment Method</option>
                                                                        <option value="online_upi">Online UPI</option>
                                                                        <option value="offline_cash">Offline Cash</option>
                                                                    </select>
                                                                </div>
                                                                <div class="payment-details">
                                                                    <div class="form-group row">
                                                                        <label for="payment_date" class="col-sm-4 col-form-label">Payment Date</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="datetime-local" class="form-control" id="payment_date" name="payment_date" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="transaction_id" class="col-sm-4 col-form-label">Transaction ID</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" id="transaction_id" name="transaction_id" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="gst" class="col-sm-4 col-form-label">GST (%)</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="number" step="0.01" min="0" max="100" class="form-control" id="gst" name="gst" value="{{ $totalTaxRate }}" required>

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="subtotal" class="col-sm-4 col-form-label">Sub Total</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="number" step="0.01" min="0" class="form-control" id="subtotal" name="subtotal"   value="{{ $invoice->total_amount }}" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="total_amount">Payment Amount</label>
                                                                    <input type="number" class="form-control" id="total_amount" name="total_amount" placeholder="Enter payment amount"   value="{{ $invoice->total_amount }}" required>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </form>



                                                    </div>
                                                </div>
                                            </div>
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
