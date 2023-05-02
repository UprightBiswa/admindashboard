@extends('layouts.auth')

@section('content')
    {{-- <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">Quotation >> <strong>ID: #123-123</strong></p>
                      </div>
                      <div class="col-xl-3 float-end">
                        <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                            class="fas fa-print text-primary"></i> Print</a>
                        <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
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
                                <li class="text-muted">To: <span style="color:#5d9fc5 ;">John Lorem</span></li>
                                <li class="text-muted">Street, City</li>
                                <li class="text-muted">State, Country</li>
                                <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li>
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Quotation</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">ID:</span>#123-456</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">Creation Date: </span>Jun 23,2021</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">Expiry Date: </span>Jun 23,2021</li>

                            </ul>
                        </div>
                    </div>

                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Pro Package</td>
                                    <td>4</td>
                                    <td>$200</td>
                                    <td>$800</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Web hosting</td>
                                    <td>1</td>
                                    <td>$10</td>
                                    <td>$10</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Consulting</td>
                                    <td>1 year</td>
                                    <td>$300</td>
                                    <td>$300</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <p class="ms-3">Add additional notes and payment information</p>

                        </div>
                        <div class="col-xl-3">
                            <ul class="list-unstyled">
                                <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1110</li>
                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li>
                            </ul>
                            <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                                    style="font-size: 25px;">$1221</span></p>
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
    </div> --}}

    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quotation Details</h3>
                    <div class="card-tools">
                        <a href="{{ url('admin/quotations') }}" class="btn btn-sm btn-primary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Customer Name:</strong> {{ $quotation->customer->name }}</p>
                            <p><strong>Quotation Number:</strong> {{ $quotation->uuid }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Created At:</strong> {{ $quotation->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Tax (%)</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if($quotation && $quotation->quotationItems)
                            @foreach($quotation->quotationItems as $index => $item)
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
            </div>
        </div>
    </div>
</div>



{{-- <section class="pb-4">
    <div class="bg-white border rounded-5">

      <section class="w-100 p-4 justify-content-center">
        <div class="card">
          <div class="card-body">
            <div class="container mb-5 mt-3">
              <div class="row d-flex align-items-baseline">
                <div class="col-xl-9">
                  <p style="color: #7e8d9f;font-size: 20px;">Invoice &gt;&gt; <strong>ID: #123-123</strong></p>
                </div>
                <div class="col-xl-3 float-end">
                  <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i class="fas fa-print text-primary"></i> Print</a>
                  <a class="btn btn-light text-capitalize ripple-surface-dark" data-mdb-ripple-color="dark" style=""><i class="far fa-file-pdf text-danger"></i> Export</a>
                </div>
                <hr>
              </div>

              <div class="container">
                <div class="col-md-12">
                  <div class="text-center">
                    <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                    <p class="pt-0">MDBootstrap.com</p>
                  </div>

                </div>


                <div class="row">
                  <div class="col-xl-8">
                    <ul class="list-unstyled">
                      <li class="text-muted">To: <span style="color:#5d9fc5 ;">John Lorem</span></li>
                      <li class="text-muted">Street, City</li>
                      <li class="text-muted">State, Country</li>
                      <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li>
                    </ul>
                  </div>
                  <div class="col-xl-4">
                    <p class="text-muted">Invoice</p>
                    <ul class="list-unstyled">
                      <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">ID:</span>#123-456</li>
                      <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="fw-bold">Creation Date: </span>Jun 23,2021</li>
                      <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                          Unpaid</span></li>
                    </ul>
                  </div>
                </div>

                <div class="row my-2 mx-1 justify-content-center">
                  <table class="table table-striped table-borderless">
                    <thead style="background-color:#84B0CA ;" class="text-white">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Pro Package</td>
                        <td>4</td>
                        <td>$200</td>
                        <td>$800</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Web hosting</td>
                        <td>1</td>
                        <td>$10</td>
                        <td>$10</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Consulting</td>
                        <td>1 year</td>
                        <td>$300</td>
                        <td>$300</td>
                      </tr>
                    </tbody>

                  </table>
                </div>
                <div class="row">
                  <div class="col-xl-8">
                    <p class="ms-3">Add additional notes and payment information</p>

                  </div>
                  <div class="col-xl-3">
                    <ul class="list-unstyled">
                      <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>$1110</li>
                      <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li>
                    </ul>
                    <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span style="font-size: 25px;">$1221</span></p>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-xl-10">
                    <p>Thank you for your purchase</p>
                  </div>
                  <div class="col-xl-2">
                    <button type="button" class="btn btn-primary text-capitalize" style="background-color:#60bdf3 ;">Pay
                      Now</button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>



      <div class="p-4 text-center border-top mobile-hidden">
        <a class="btn btn-link px-3" data-mdb-toggle="collapse" href="#example2" role="button" aria-expanded="true" aria-controls="example2" data-ripple-color="hsl(0, 0%, 67%)" style="">
          <i class="fas fa-code me-md-2"></i>
          <span class="d-none d-md-inline-block">
            Show code
          </span>
        </a>


          <a class="btn btn-link px-3" data-ripple-color="hsl(0, 0%, 67%)" style="">
            <i class="fas fa-file-code me-md-2 pe-none"></i>
            <span class="d-none d-md-inline-block export-to-snippet pe-none">
              Edit in sandbox
            </span>
          </a>

      </div>


    </div>
  </section> --}}

@endsection
