@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Quotation
                        <a href="{{ url('admin/quotations') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                    </h5>
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
                                    <th>rate</th>
                                    <th>tax_rate</th>
                                    <th>amount</th>
                                    <th>Delete Row</th>
                                </tr>
                            </thead>
                            <tbody id="quotation-items">
                                @foreach ($quotation->quotationitems as $index => $quotationitem)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <input type="text" name="descriptions[]" id="descriptions"
                                                class="form-control" value="{{ $quotationitem->description }}">
                                        </td>
                                        <td>
                                            <select name="service_id[]" id="service_id" class="form-control">
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}"
                                                        @if ($service->id == $quotationitem->service_id) selected @endif>
                                                        {{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="quantity[]" id="quantity" class="form-control"
                                                oninput="calculateAmount(this)" value="{{ $quotationitem->quantity }}">
                                        </td>
                                        <td>
                                            <input type="text" name="rate[]" id="rate" class="form-control"
                                                oninput="calculateAmount(this)" value="{{ $quotationitem->rate }}">
                                        </td>
                                        <td>
                                            <input type="text" name="tax_rate[]" id="tax_rate" class="form-control"
                                                oninput="calculateAmount(this)" value="{{ $quotationitem->tax_rate }}">
                                        </td>
                                        <td>
                                            <input type="text" name="amount[]" id="amount" class="form-control"
                                                value="{{ $quotationitem->amount }}" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="mdi btn-inverse-danger"
                                                onclick="deleteQuotationItem(this)">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="mdi btn-inverse-success" onclick="addQuotationItem()">Add Item</button>
                        <hr>
                        <button type="submit" class="mdi btn-inverse-primary">Update Quotation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function calculateAmount(input) {
            var row = input.parentNode.parentNode;
            var quantity = row.querySelector('input[name="quantity[]"]').value;
            var rate = row.querySelector('input[name="rate[]"]').value;
            var taxRate = row.querySelector('input[name="tax_rate[]"]').value;

            var qAmount = quantity * rate;
            var totalTax = qAmount * (taxRate / 100);
            var totalAmountItem = qAmount + totalTax;

            row.querySelector('input[name="amount[]"]').value = totalAmountItem.toFixed(2);
        }
    </script>
    <script>
        function addQuotationItem() {
            var quotationItems = document.getElementById('quotation-items');
            var rowCount = quotationItems.rows.length;
            var row = quotationItems.insertRow(rowCount);

            var cell0 = row.insertCell(0);
            var number = document.createTextNode(rowCount + 1);
            cell0.appendChild(number);

            var cell1 = row.insertCell(1);
            var descriptionInput = document.createElement('input');
            descriptionInput.type = 'text';
            descriptionInput.name = 'descriptions[]';
            descriptionInput.id = 'descriptions';
            descriptionInput.className = 'form-control';
            cell1.appendChild(descriptionInput);

            var cell2 = row.insertCell(2);
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
            cell2.appendChild(serviceSelect);

            //quantity
            var cell3 = row.insertCell(3);
            var quantityInput = document.createElement('input');
            quantityInput.type = 'text';
            quantityInput.name = 'quantity[]';
            quantityInput.id = 'quantity';
            quantityInput.className = 'form-control';
            quantityInput.addEventListener('input', function() {
                calculateAmount(this);
            });
            cell3.appendChild(quantityInput);


            //rate
            var cell4 = row.insertCell(4);
            var rateInput = document.createElement('input');
            rateInput.type = 'text';
            rateInput.name = 'rate[]';
            rateInput.id = 'rate';
            rateInput.className = 'form-control';
            rateInput.addEventListener('input', function() {
                calculateAmount(this);
            });
            cell4.appendChild(rateInput);


            //tax
            var cell5 = row.insertCell(5);
            var taxRateInput = document.createElement('input');
            taxRateInput.type = 'text';
            taxRateInput.name = 'tax_rate[]';
            taxRateInput.id = 'tax_rate';
            taxRateInput.className = 'form-control';
            taxRateInput.addEventListener('input', function() {
                calculateAmount(this);
            });
            cell5.appendChild(taxRateInput);


            //amount
            var cell6 = row.insertCell(6);
            var amountInput = document.createElement('input');
            amountInput.type = 'text';
            amountInput.name = 'amount[]';
            amountInput.id = 'amount';
            amountInput.className = 'form-control';
            amountInput.readOnly = true;
            cell6.appendChild(amountInput);


            //delete
            var cell7 = row.insertCell(7);
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
