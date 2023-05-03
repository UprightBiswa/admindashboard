@extends('layouts.auth')

@section('content')
<div class="container">
    <h1>Edit Quotation</h1>
    <form action="{{ url('admin/quotations/'.$quotation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select name="customer_id" id="customer_id" class="form-control">
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" @if($customer->id == $quotation->customer_id) selected @endif>{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $quotation->date }}">
        </div> --}}
        <hr>
        <h3>Quotation Items</h3>
        <div id="quotation-items">
            @foreach($quotation->quotationitems as $quotationitem)
                <div class="form-group">
                    <label for="service_id">Service</label>
                    <select name="service_id[]" id="service_id" class="form-control">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" @if($service->id == $quotationitem->service_id) selected @endif>{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="descriptions">Descriptions</label>
                    <input type="text" name="description[]" id="description" class="form-control" value="{{ $quotationitem->description }}">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="text" name="quantity[]" id="quantity" class="form-control" value="{{ $quotationitem->quantity }}">
                </div>

                <div class="form-group">
                    <label for="rate">Rate</label>
                    <input type="text" name="rate[]" id="rate" class="form-control" value="{{ $quotationitem->rate }}">
                </div>
                <div class="form-group">
                    <label for="quantity">Tax</label>
                    <input type="text" name="tax_rate[]" id="tax_rate" class="form-control" value="{{ $quotationitem->tax_rate }}">
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-success" onclick="addQuotationItem()">Add Item</button>
        <hr>
        <button type="submit" class="btn btn-primary">Update Quotation</button>
    </form>
</div>
<script>
    function addQuotationItem() {
        var quotationItems = document.getElementById('quotation-items');
        var html = `
            <div class="form-group">
                <label for="service_id">Service</label>
                <select name="service_id[]" id="service_id" class="form-control">
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="descriptions">Descriptions</label>
                <input type="text" name="description[]" id="description" class="form-control">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" name="quantity[]" id="quantity" class="form-control">
            </div>

            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="text" name="rate[]" id="rate" class="form-control">
            </div>
            <div class="form-group">
                <label for="quantity">Tax</label>
                <input type="text" name="tax_rate[]" id="tax_rate" class="form-control">
            </div>
        `;
        var div = document.createElement('div');
        div.innerHTML = html;
        quotationItems.appendChild(div);
    }
</script>

@endsection

