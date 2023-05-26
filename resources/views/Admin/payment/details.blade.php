@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Payment for Invoice #{{ $invoice->id }} - {{ $customer->name }}
                        <a href="{{ url('admin/invoices') }}" class="btn btn-outline-danger btn-sm  float-end">BACK</a>
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ url('admin/invoices/' . $invoice->id . '/payment') }}" method="POST" id="paymentForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="payment_method">Payment Method</label>
                                <select class="form-control" id="payment_method" name="payment_method" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="online_upi">Online UPI</option>
                                    <option value="offline_cash">Offline Cash</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="payment_date">Payment Date</label>
                                <input type="datetime-local" class="form-control" id="payment_date" name="payment_date"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="transaction_id">Transaction ID</label>
                                <input type="text" class="form-control" id="transaction_id" name="transaction_id"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gst">GST (%)</label>
                                <input type="number" step="0.01" min="0" max="100" class="form-control"
                                    id="gst" name="gst" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sub_total">Sub Total</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="sub_total"
                                    name="sub_total" value="{{ $invoice->total_amount }}" readonly>
                            </div>
                            <!-- Add more payment input fields here -->
                            <div class="col-md-6 mb-3">
                                <label for="total_amount">Payment Amount</label>
                                <input type="number" class="form-control" id="total_amount" name="total_amount"
                                    placeholder="Enter payment amount" value="{{ $invoice->total_amount }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ url('admin/invoices') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
