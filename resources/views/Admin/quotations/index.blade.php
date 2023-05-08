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
                        <h1>Quotations</h1>
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
                                            <th> <a href="{{ url('admin/quotations/create') }}"
                                                    class="btn btn-sm btn-primary mb-3 ">New Quotation</a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($quotations as $index => $quotation)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
