@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="col-sm-3 col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body dashboard-tabs p-0">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <i class="mdi mdi-account-star me-1 icon-lg text-danger"></i>
                            <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">Total Customers</small>
                                <H3 class="me-2  text-center mb-0">{{ $customersCount }}</H3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body dashboard-tabs p-0">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <i class="mdi mdi-eye me-1 icon-lg text-success"></i>
                            <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">Total Services</small>
                                <H3 class="me-2  text-center mb-0">{{ $servicesCount }}</H3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body dashboard-tabs p-0">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <i class="mdi mdi-download me-1 icon-lg text-warning"></i>
                            <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">Total Invoices</small>
                                <H3 class="me-2  text-center mb-0">{{ $invoicesCount }}</H3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-md-3 grid-margin stretch-card">
                <div class="card ">
                    <div class="card-body dashboard-tabs p-0">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <i class="mdi mdi-flag me-1 icon-lg text-danger"></i>
                            <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">Total Quotations</small>
                                <H3 class=" text-center">{{ $quotationsCount }}</H3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Due Amount</p>
                    <p class="mb-4">Customers with due amount</p>
                    <div class="table-responsive">
                        <table id="recent-purchases-listing" class="table table-bordered">
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
        <div class="col-md-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body dashboard-tabs p-0">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <i class="mdi mdi-currency-usd me-1 icon-lg text-danger"></i>
                                        <div class="d-flex flex-column justify-content-around">
                                            <small class="mb-1 text-muted">Total Amount</small>
                                            <h5>{{ $totalAmount }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body dashboard-tabs p-0">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <i class="mdi mdi-currency-usd me-1 icon-lg text-success"></i>
                                        <div class="d-flex flex-column justify-content-around">
                                            <small class="mb-1 text-muted">Total Paid Amount</small>
                                            <h5>{{ $paidAmount }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body dashboard-tabs p-0">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <i class="mdi mdi-currency-usd me-1 icon-lg text-danger"></i>
                                        <div class="d-flex flex-column justify-content-around">
                                            <small class="mb-1 text-muted">Total Due Amount</small>
                                            <h5>{{ $dueAmount }}</h5>
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
