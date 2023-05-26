@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Invoice Details
                        <a href="{{ url('admin/invoices') }}" class="btn btn-outline-danger btn-sm  float-end">BACK</a>
                    </h5>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="container mb-5 mt-3">
                                    <div class="row d-flex align-items-baseline">
                                        <div class="col-xl-9">
                                            <p style="color: #934545;font-size: 20px;">invoice >> <strong>ID:
                                                    #{{ $invoiceId }}</strong></p>
                                        </div>
                                        <div class="col-xl-3 float-end">
                                            <a href="{{ url('admin/invoices/pdf', $invoice) }}" target="_blank"
                                                class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark">
                                                <i class="mdi mdi-printer text-primary "></i> Print
                                            </a>
                                            <a href="{{ url('admin/invoices/pdf', $invoice) }}"
                                                class="btn btn-light text-capitalize" data-mdb-ripple-color="dark">
                                                <i class="mdi mdi-file-pdf text-danger"></i> Export</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="container">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <img src="{{ asset('theme/images/logo.png') }}"style="max-width: 300px; max-height: 300px;"
                                                    alt="logo" class="img-fluid" />
                                                <address class="pt-0">Techmion Solutions India Private Limited
                                                </address>
                                                <address class="pt-0">Dreamland Arcade, Police Bazar</address>
                                                <address class="pt-0">Shillong – 793001.</address>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-8">
                                                <ul class="list-unstyled">
                                                    <li class="text-muted">To: <span style="color:#caa957 ;">
                                                            {{ $invoice->customer->name }}</span></li>
                                                    <li class="text-muted"><i class="mdi mdi-phone"
                                                            style="color:#caa957 ;"></i> Phone:
                                                        {{ $invoice->customer->phone }}</li>
                                                    <li class="text-muted"><i class="mdi mdi-email"
                                                            style="color:#caa957 ;"></i> Email:
                                                        {{ $invoice->customer->email }}</li>
                                                    <li class="text-muted"><i class="mdi mdi-account-card-details"
                                                            style="color:#caa957 ;"></i> GST:
                                                        {{ $invoice->customer->gst_no }}</li>
                                                    <li class="text-muted"><i class="mdi mdi-home"
                                                            style="color:#caa957 ;"></i> Address:
                                                        {{ $invoice->customer->address }}</li>
                                                </ul>
                                            </div>
                                            <div class="col-xl-4">
                                                <p class="text-muted">Invoice</p>
                                                <ul class="list-unstyled">
                                                    <li class="text-muted"><i class="mdi mdi-checkbox-blank-circle"
                                                            style="color:#934545 ;"></i> <span
                                                            class="fw-bold">ID:</span>#{{ $invoiceId }}</li>
                                                    <li class="text-muted"><i class="mdi mdi-checkbox-blank-circle"
                                                            style="color:#934545 ;"></i> <span class="fw-bold">Creation
                                                            Date: </span>
                                                        {{ \Carbon\Carbon::parse($invoice->issue_date)->format('d/m/Y H:i:s') }}
                                                    </li>
                                                    <li class="text-muted"><i class="mdi mdi-checkbox-blank-circle"
                                                            style="color:#934545 ;"></i> <span class="fw-bold">Expiry
                                                            Date: </span>
                                                        {{ \Carbon\Carbon::parse($invoice->expiry_date)->format('d/m/Y H:i:s') }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="row my-2 mx-1 justify-content-center">
                                            <table class="table table-striped table-borderless">
                                                <thead style="background-color:#caa957 ;" class="text-white">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">SERVICE</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">QUANTITY</th>
                                                        <th scope="col">RATE</th>
                                                        <th scope="col"> TAX (%) </th>
                                                        <th scope="col"> discount (%) </th>
                                                        <th scope="col">AMOUNT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($invoice && $invoice->invoiceItems)
                                                        @foreach ($invoice->invoiceItems as $index => $item)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $item->service->name }}</td>
                                                                <td>{{ $item->description }}</td>
                                                                <td>{{ $item->quantity }}</td>
                                                                <td>{{ $item->rate }}</td>
                                                                <td>{{ $item->tax_rate }}</td>
                                                                <td>{{ $item->discount }}</td>
                                                                <td>{{ $item->amount }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-8">
                                                <p class="ms-3">Add additional notes and payment information</p>

                                            </div>
                                            <div class="col-xl-3">
                                                <ul class="list-unstyled">
                                                    <li class="text-muted ms-3"><span
                                                            class="text-black me-4">SubTotal:</span>{{ $subtotal }}
                                                    </li>
                                                    <li class="text-muted ms-3 mt-2"><span
                                                            class="text-black me-4">Tax(15%):</span>{{ $subtotal * 0.15 }}
                                                    </li>
                                                </ul>
                                                <p class="text-black float-start">
                                                    <span class="text-black me-3">
                                                        Total Amount:
                                                    </span>
                                                    <span style="font-size: 25px;">
                                                        {{ $subtotal * 1.15 }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div>
                                                <h3 style="color: {{ $invoice->payment_status == 1 ? 'green' : 'red' }};">
                                                    payment:
                                                    <span>{{ $invoice->payment_status == 1 ? 'successfull' : 'due' }}</span>
                                                </h3>
                                                @if (!$invoice->payment_status)
                                                    <a href="{{ url('admin/invoices/' . $invoice->id . '/payment') }}"
                                                        class="btn btn-sm btn-success">Payment</a>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <p>Thank you for your purchase</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
