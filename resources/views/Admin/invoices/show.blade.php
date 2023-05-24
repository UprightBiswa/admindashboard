@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Invoice Details
                        <a href="{{ url('admin/invoices') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container mb-5 mt-3">
                                        <div class="row d-flex align-items-baseline">
                                            <div class="col-xl-9">
                                                <p style="color: #7e8d9f;font-size: 20px;">invoice >> <strong>ID:
                                                        #{{ $invoice->uuid }}</strong></p>
                                            </div>
                                            <div class="col-xl-3 float-end">
                                                <a href="{{ url('admin/invoices/pdf', $invoice) }}" target="_blank"
                                                    class="btn btn-light text-capitalize border-0"
                                                    data-mdb-ripple-color="dark">
                                                    <i class="fas fa-print text-primary"></i> Print
                                                </a>


                                                <a href="{{ url('admin/invoices/pdf', $invoice) }}"
                                                    class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                                                        class="far fa-file-pdf text-danger"></i> Export</a>
                                            </div>
                                            <hr>
                                        </div>

                                        <div class="container">
                                            <div class="col-md-12">
                                                <div class="text-center">
                                                    <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                                                    <p class="pt-0">CompanyName.com</p>
                                                    <p class="pt-0">Street, City.com</p>
                                                    <p class="pt-0">State.com</p>

                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-xl-8">
                                                    <ul class="list-unstyled">
                                                        <li class="text-muted">To: <span style="color:#5d9fc5 ;">
                                                                {{ $invoice->customer->name }}</span></li>
                                                        <li class="text-muted"> {{ $invoice->customer->email }}</li>
                                                        <li class="text-muted"> {{ $invoice->customer->gst_no }}</li>
                                                        <li class="text-muted"> {{ $invoice->customer->address }}</li>
                                                        <li class="text-muted"><i class="fas fa-phone"></i>
                                                            {{ $invoice->customer->phone }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-xl-4">
                                                    <p class="text-muted">invoice</p>
                                                    <ul class="list-unstyled">
                                                        <li class="text-muted"><i class="fas fa-circle"
                                                                style="color:#84B0CA ;"></i> <span
                                                                class="fw-bold">ID:</span>#{{ $invoice->uuid }}</li>
                                                        <li class="text-muted"><i class="fas fa-circle"
                                                                style="color:#84B0CA ;"></i> <span class="fw-bold">Creation
                                                                Date: </span>
                                                            {{ \Carbon\Carbon::parse($invoice->issue_date)->format('d/m/Y H:i:s') }}
                                                        </li>
                                                        <li class="text-muted"><i class="fas fa-circle"
                                                                style="color:#84B0CA ;"></i> <span class="fw-bold">Expiry
                                                                Date:
                                                            </span>
                                                            {{ \Carbon\Carbon::parse($invoice->expiry_date)->format('d/m/Y H:i:s') }}
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>

                                            <div class="row my-2 mx-1 justify-content-center">
                                                <table class="table table-striped table-borderless">
                                                    <thead style="background-color:#84B0CA ;" class="text-white">
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
                                                            @php
                                                                $subtotal = 0;
                                                            @endphp
                                                            @foreach ($invoice->invoiceItems as $index => $item)
                                                                @php
                                                                    $qAmount = $item->quantity * $item->rate;
                                                                    $totaltax = $qAmount * ($item->tax_rate / 100);
                                                                    $totalAmount = $qAmount + $totaltax;
                                                                    $subtotal += $totalAmount;
                                                                @endphp
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
                                                                class="text-black me-4">SubTotal</span>${{ $subtotal }}
                                                        </li>
                                                        <li class="text-muted ms-3 mt-2"><span
                                                                class="text-black me-4">Tax(15%)</span>${{ $subtotal * 0.15 }}
                                                        </li>
                                                    </ul>
                                                    <p class="text-black float-start">
                                                        <span class="text-black me-3">
                                                            Total Amount
                                                        </span>
                                                        <span style="font-size: 25px;">
                                                            ${{ $subtotal * 1.15 }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <div>
                                                    <h3 style="color: {{ $invoice->payment_status == 1 ? 'green' : 'red' }};"> payment: <span>{{ $invoice->payment_status == 1 ? 'successfull' : 'due' }}</span> </h3>
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
    </div>
@endsection
