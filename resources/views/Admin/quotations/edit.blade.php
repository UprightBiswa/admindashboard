@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Quotation
                        <a href="{{ url('admin/quotations') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                    </h3>
                </div>


                <div class="card-body">
                    <form action="{{ url('admin/quotations/' . $quotation->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-control">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                @if ($customer->id == $quotation->customer_id) selected @endif>
                                                {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="issue_date">issue_date</label>
                                    <input type="date" name="issue_date" id="issue_date" class="form-control"
                                        value="{{ $quotation->issue_date }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="expiry_date">expiry_date</label>
                                    <input type="date" name="expiry_date" id="expiry_date" class="form-control"
                                        value="{{ $quotation->expiry_date }}">
                                </div>
                            </div>
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
                                    <th>Delete Row</th>
                                </tr>
                            </thead>
                            <tbody id="quotation-items">
                                @foreach ($quotation->quotationitems as $index => $quotationitem)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><input type="text" name="descriptions[]" id="descriptions"
                                                class="form-control" value="{{ $quotationitem->description }}"></td>
                                        <td>
                                            <select name="service_id[]" id="service_id" class="form-control">
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}"
                                                        @if ($service->id == $quotationitem->service_id) selected @endif>
                                                        {{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="quantity[]" id="quantity" class="form-control"
                                                value="{{ $quotationitem->quantity }}"></td>
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
            </div>
        </div>
    </div>
    <script>
        function addQuotationItem() {
            var quotationItems = document.getElementById('quotation-items');
            var rowCount = quotationItems.rows.length;
            var row = quotationItems.insertRow(rowCount);

            var cell1 = row.insertCell(0);
            var number = document.createTextNode(rowCount + 1);
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

            var cell7 = row.insertCell(4);
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

        addQuotationItem();
    </script>
@endsection
