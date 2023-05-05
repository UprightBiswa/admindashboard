{{-- @extends('layouts.auth')

@section('content') --}}
{{-- <div class="container">
    <h1>Edit Quotation</h1>
    <form action="{{ url('admin/quotations/'.$quotation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select name="customer_id" id="customer_id" class="form-control">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" @if ($customer->id == $quotation->customer_id) selected @endif>{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="issue_date">issue_date</label>
            <input type="date" name="issue_date" id="issue_date" class="form-control" value="{{ $quotation->issue_date }}">
        </div>
        <div class="form-group">
            <label for="expiry_date">expiry_date</label>
            <input type="date" name="expiry_date" id="expiry_date" class="form-control" value="{{ $quotation->expiry_date }}">
        </div>
        <hr>
        <h3>Quotation Items</h3>
        <div id="quotation-items">
            @foreach ($quotation->quotationitems as $quotationitem)
                <div class="form-group">
                    <label for="service_id">Service</label>
                    <select name="service_id[]" id="service_id" class="form-control">
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}" @if ($service->id == $quotationitem->service_id) selected @endif>{{ $service->name }}</option>
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
                    @foreach ($services as $service)
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
</script> --}}



@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-9">  <h1>Edit Quotation</h1></div>
            <div class="col-sm-2" ><a href="{{ url('admin/quotations') }}" class="btn btn-sm btn-primary mb-3 ">BACK</a></div>
        </div>

        <form action="{{ url('admin/quotations/' . $quotation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="customer_id">Customer</label>
                <select name="customer_id" id="customer_id" class="form-control">
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" @if ($customer->id == $quotation->customer_id) selected @endif>
                            {{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="issue_date">issue_date</label>
                <input type="date" name="issue_date" id="issue_date" class="form-control"
                    value="{{ $quotation->issue_date }}">
            </div>
            <div class="form-group">
                <label for="expiry_date">expiry_date</label>
                <input type="date" name="expiry_date" id="expiry_date" class="form-control"
                    value="{{ $quotation->expiry_date }}">
            </div>
            <hr>
            <h3>Quotation Items</h3>
            <table class="table table-striped table-bordered">
                <thead style="background-color:#84B0CA;" class="text-white">
                    <tr>
                        <th>#</th>
                        <th>Descriptions</th>
                        <th>Service</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>Tax Amount</th>
                        <th>Delete Row</th>
                    </tr>
                </thead>
                <tbody id="quotation-items">
                    @foreach ($quotation->quotationitems as $index => $quotationitem)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><input type="text" name="descriptions[]" id="descriptions" class="form-control"
                                    value="{{ $quotationitem->description }}"></td>
                            <td>
                                <select name="service_id[]" id="service_id" class="form-control">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"
                                            @if ($service->id == $quotationitem->service_id) selected @endif>{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" name="quantity[]" id="quantity" class="form-control"
                                    value="{{ $quotationitem->quantity }}"></td>
                            <td><input type="text" name="rate[]" id="rate" class="form-control"
                                    value="{{ $quotationitem->rate }}"></td>
                            <td><input type="text" name="tax_rate[]" id="tax_rate" class="form-control"
                                    value="{{ $quotationitem->tax_rate }}"></td>
                            <td><button type="button" class="btn btn-danger"
                                    onclick="deleteQuotationItem(this)">Delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="btn btn-success" onclick="addQuotationItem()">Add Item</button>
            <hr>
            <button type="submit" class="btn btn-primary">Update Quotation</button>
        </form>
    </div>

    <script>
       function addQuotationItem() {
    var quotationItems = document.getElementById('quotation-items');
    var rowCount = quotationItems.rows.length;
    var row = quotationItems.insertRow(rowCount);

    var cell1 = row.insertCell(0);
    var number = document.createTextNode(rowCount+1); // use rowCount + 1 to start from 1
    cell1.appendChild(number);

    var cell2 = row.insertCell(1);
    var descriptionInput = document.createElement('input');
    descriptionInput.type = 'text';
    descriptionInput.name = 'descriptions[]';
    descriptionInput.id = 'descriptions';
    descriptionInput.className = 'form-control';
    cell2.appendChild(descriptionInput);

    var cell3 = row.insertCell(2);
    var serviceSelect = document.createElement('select');
    serviceSelect.name = 'service_id[]';
    serviceSelect.id = 'service_id';
    serviceSelect.className = 'form-control';
    @foreach ($services as $service)
        var option{{ $service->id }} = document.createElement('option');
        option{{ $service->id }}.value = '{{ $service->id }}';
        option{{ $service->id }}.text = '{{ $service->name }}';
        serviceSelect.appendChild(option{{ $service->id }});
    @endforeach
    cell3.appendChild(serviceSelect);

    var cell4 = row.insertCell(3);
    var quantityInput = document.createElement('input');
    quantityInput.type = 'text';
    quantityInput.name = 'quantity[]';
    quantityInput.id = 'quantity';
    quantityInput.className = 'form-control';
    cell4.appendChild(quantityInput);

    var cell5 = row.insertCell(4);
    var rateInput = document.createElement('input');
    rateInput.type = 'text';
    rateInput.name = 'rate[]';
    rateInput.id = 'rate';
    rateInput.className = 'form-control';
    cell5.appendChild(rateInput);

    var cell6 = row.insertCell(5);
    var taxInput = document.createElement('input');
    taxInput.type = 'text';
    taxInput.name = 'tax_rate[]';
    taxInput.id = 'tax_rate';
    taxInput.className = 'form-control';
    cell6.appendChild(taxInput);

    var cell7 = row.insertCell(6);
    var deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.className = 'btn btn-danger';
    deleteButton.onclick = function() {
        deleteQuotationItem(this)
    };
    var buttonText = document.createTextNode('Delete');
    deleteButton.appendChild(buttonText);
    cell7.appendChild(deleteButton);
}

function deleteQuotationItem(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

// Call the addQuotationItem() function once to add the first row with serial number 1
addQuotationItem();

    </script>
@endsection
