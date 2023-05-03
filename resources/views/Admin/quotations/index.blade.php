@extends('layouts.auth')

@section('content')


<div class="p-3 mb-2 bg-gradient-primary text-white text-center">
    <h3 class="bg-primary d-inline-block px-3 py-2 rounded">Quotations</h3>
  </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-9"><h5 >All Quotations Details</h5></div>
            <div class="col-sm-2" ><a href="{{ url('admin/quotations/create') }}" class="btn btn-sm btn-primary mb-3 ">New Quotation</a></div>
        </div>


        <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA ;" class="text-white">
                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotations as $index =>  $quotation )
                    <tr>
                        <td>{{ $index + 1  }}</td>
                        <td>{{ $quotation->customer->name }}</td>
                        <td>{{ $quotation->created_at }}</td>
                        <td>
                            @php
                            $totalQuantity = 0;
                            foreach($quotation->quotationItems as $quotationItem) {
                                $totalQuantity += $quotationItem->quantity;
                            }
                            echo $totalQuantity;
                        @endphp
                        </td>
                        <td>
                            @php
                            $totalAmount = 0;
                            foreach($quotation->quotationItems as $quotationItem) {
                                $totalAmount += $quotationItem->quantity * $quotationItem->rate;
                            }
                            echo $totalAmount;
                        @endphp
                        </td>
                        <td>
                            <a href="{{ url('admin/quotations', $quotation) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ url('admin/quotations/'.$quotation->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ url('admin/quotations', $quotation) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this quotation?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>





  @endsection

