<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>quotaion PDF</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container mb-5 mt-3">
                            <div class="row d-flex align-items-baseline">
                                <div class="col-xl-12">
                                    <p style="color: #934545;font-size: 20px;">Quotation >> <strong>ID:
                                            #{{ $quotationId }}</strong></p>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <img src="{{ asset('theme/images/logo.png') }}"style="max-width: 300px; max-height: 300px;"
                                            alt="logo" class="img-fluid" />

                                        <address class="mdi mdi-briefcase ms-0" style="color:#caa957 ;">Techmion
                                            Solutions India Private Limited</address>
                                        <address class="pt-0">Dreamland Arcade, Police Bazar</address>
                                        <address class="pt-0">Shillong – 793001.</address>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xl-8">
                                        <ul class="list-unstyled">
                                            <li class="text-muted">To: <span style="color:#caa957 ;">
                                                    {{ $quotation->customer->name }}</span></li>
                                            <li class="text-muted"><i class="mdi mdi-phone" style="color:#caa957 ;"></i>
                                                Phone:
                                                {{ $quotation->customer->phone }}</li>
                                            <li class="text-muted"><i class="mdi mdi-email" style="color:#caa957 ;"></i>
                                                Email:
                                                {{ $quotation->customer->email }}</li>
                                            <li class="text-muted"><i class="mdi mdi-account-card-details"
                                                    style="color:#caa957 ;"></i> GST:
                                                {{ $quotation->customer->gst_no }}</li>
                                            <li class="text-muted"><i class="mdi mdi-home" style="color:#caa957 ;"></i>
                                                Address:
                                                {{ $quotation->customer->address }}</li>
                                        </ul>
                                    </div>


                                    <div class="col-xl-4">
                                        <p class="text-muted">Quotation</p>
                                        <ul class="list-unstyled">
                                            <li class="text-muted"><i class="mdi mdi-checkbox-blank-circle"
                                                    style="color:#934545 ;"></i> <span
                                                    class="fw-bold">ID:</span>#{{ $quotationId }}</li>
                                            <li class="text-muted"><i class="mdi mdi-checkbox-blank-circle"
                                                    style="color:#934545 ;"></i> <span class="fw-bold">Creation
                                                    Date: </span>
                                                {{ \Carbon\Carbon::parse($quotation->issue_date)->format('d/m/Y H:i:s') }}
                                            </li>
                                            <li class="text-muted"><i class="mdi mdi-checkbox-blank-circle"
                                                    style="color:#934545 ;"></i> <span class="fw-bold">Expiry
                                                    Date: </span>
                                                {{ \Carbon\Carbon::parse($quotation->expiry_date)->format('d/m/Y H:i:s') }}
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
                                                <th scope="col">AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($quotation && $quotation->quotationItems)
                                                @foreach ($quotation->quotationItems as $index => $item)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $item->service->name }}</td>
                                                        <td>{{ $item->description }}</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ $item->rate }}</td>
                                                        <td>{{ $item->tax_rate }}</td>
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
                                        <p class="text-black float-start"><span class="text-black me-3"> Total
                                                Amount</span><span
                                                style="font-size: 25px;">${{ $subtotal * 1.15 }}</span></p>
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
</body>
</html>
