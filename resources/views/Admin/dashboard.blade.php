@extends('layouts.auth')

@section('content')

<h1 style="color: #ff4a4a; font-family: Arial, sans-serif; background-image: url('/images/background.jpg'); background-size: cover; padding: 20px;">Dashboard</h1>

<div class="row">
    <div class="col-md-3">
        <div class="card" style="background-image: url('https://source.unsplash.com/random/800x600')">
            <div class="card-body">
                <h5 class="card-title">Total Customers</h5>
                <p class="card-text">{{ $customersCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" style="background-color: #a80000; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
            <div class="card-body">
                <h5 class="card-title">Total Services</h5>
                <p class="card-text">{{ $servicesCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" style="background-color: #0dab79; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
            <div class="card-body">
                <h5 class="card-title">Total Invoices</h5>
                <p class="card-text">{{ $invoicesCount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card" style="background-color: #007bff; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
            <div class="card-body">
                <h5 class="card-title">Total Quotations</h5>
                <p class="card-text">{{ $quotationsCount }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card" style="background-color: #ff8800; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
            <div class="card-body">
                <h5 class="card-title">Total Amount</h5>
                <p class="card-text">{{ $totalAmount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card" style="background-color: #7792ff; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
            <div class="card-body">
                <h5 class="card-title">Total Paid Amount</h5>
                <p class="card-text">{{ $paidAmount }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card" style="background-color: #2cff01; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
            <div class="card-body">
                <h5 class="card-title">Total Due Amount</h5>
                <p class="card-text">{{ $dueAmount }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card" style="background-color: #288f86; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.3);">
            <div class="card-body">
                <h5 class="card-title">Customers with due amount</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Due Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->customer->name }}</td>
                                <td>{{ $invoice->total_amount - $invoice->paid_amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
