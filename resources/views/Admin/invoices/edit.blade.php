@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Invoice
                        <a href="{{ url('admin/invoices') }}" class="btn btn-outline-danger btn-sm  float-end">BACK</a>
                    </h5>
                </div>


                <div class="card-body">
                    <form action="{{ url('admin/invoices/' . $invoice->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-control">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                @if ($customer->id == $invoice->customer_id) selected @endif>
                                                {{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="payment_status">Payment status</label>
                                    @if ($invoice->payment_status != 1)
                                        <select id="payment_status" name="payment_status" class="form-control">
                                            @foreach ($paymentOptions as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ $key == $invoice->payment_status ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="hidden" name="payment_status" value="1">
                                        <p>Successful</p>
                                    @endif
                                </div>
                            </div>


                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="issue_date">issue_date</label>
                                    <input type="date" name="issue_date" id="issue_date" class="form-control"
                                        value="{{ $invoice->issue_date }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="expiry_date">expiry_date</label>
                                    <input type="date" name="expiry_date" id="expiry_date" class="form-control"
                                        value="{{ $invoice->expiry_date }}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3>Invoice Items</h3>
                        <table class="table table-striped table-bordered">
                            <thead style="background-color:#84B0CA;" class="text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Descriptions</th>
                                    <th>Service</th>
                                    <th>Quantity</th>
                                    <th>rate</th>
                                    <th>tax_rate</th>
                                    <th>Discount</th>
                                    <th>amount</th>
                                    <th>Delete Row</th>
                                </tr>
                            </thead>
                            <tbody id="invoice-items">
                                @foreach ($invoice->invoiceitems as $index => $invoiceitem)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><input type="text" name="descriptions[]" id="descriptions"
                                                class="form-control" value="{{ $invoiceitem->description }}"></td>
                                        <td>
                                            <select name="service_id[]" id="service_id" class="form-control">
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}"
                                                        @if ($service->id == $invoiceitem->service_id) selected @endif>
                                                        {{ $service->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="quantity[]" id="quantity" class="form-control"
                                                oninput="calculateAmount(this)" value="{{ $invoiceitem->quantity }}"></td>

                                        <td><input type="text" name="rate[]" id="rate" class="form-control"
                                                oninput="calculateAmount(this)" value="{{ $invoiceitem->rate }}"></td>

                                        <td><input type="text" name="tax_rate[]" id="tax_rate" class="form-control"
                                                oninput="calculateAmount(this)" value="{{ $invoiceitem->tax_rate }}"></td>

                                        <td><input type="text" name="discount[]" id="discount" class="form-control"
                                                oninput="calculateAmount(this)" value="{{ $invoiceitem->discount }}"></td>

                                        <td><input type="text" name="amount[]" id="amount" class="form-control"
                                                value="{{ $invoiceitem->amount }}" readonly></td>

                                        <td><button type="button" class="mdi btn-inverse-danger"
                                                onclick="deleteQuotationItem(this)">Delete</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="mdi btn-inverse-success" onclick="addInvoiceItem()">Add Item</button>
                        <hr>
                        <button type="submit" class="mdi btn-inverse-primary">Update invoice</button>
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
            var tax_rate = row.querySelector('input[name="tax_rate[]"]').value;
            var discount = row.querySelector('input[name="discount[]"]').value;

            var qAmount = quantity * rate;
            var totalTax = qAmount * (tax_rate / 100);
            var totalAmountItem = qAmount + totalTax;

            var discountTax = totalAmountItem * (discount / 100);
            var discountAmount = totalAmountItem - discountTax;

            row.querySelector('input[name="amount[]"]').value = discountAmount.toFixed(2);
        }
    </script>
    <script>
        function addInvoiceItem() {
            var invoiceItem = document.getElementById('invoice-items');
            var rowCount = invoiceItem.rows.length;
            var row = invoiceItem.insFertRow(rowCount);

            var cell0 = row.insertCell(0);
            var number = document.createTextNode(rowCount + 1); // use rowCount + 1 to start from 1
            cell1.appendChild(number);

            var cell1 = row.insertCell(1);
            var descriptionInput = document.createElement('input');
            descriptionInput.type = 'text';
            descriptionInput.name = 'descriptions[]';
            descriptionInput.id = 'descriptions';
            descriptionInput.className = 'form-control';
            cell2.appendChild(descriptionInput);

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
            cell3.appendChild(serviceSelect);

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

            //discount
            var cell6 = row.insertCell(6);
            var discountInput = document.createElement('input');
            discountInput.type = 'text';
            discountInput.name = 'discount[]';
            discountInput.id = 'discount';
            discountInput.className = 'form-control';
            discountInput.addEventListener('input', function() {
                calculateAmount(this);
            });
            cell5.appendChild(discountInput);

            //amount
            var cell7 = row.insertCell(7);
            var amountInput = document.createElement('input');
            amountInput.type = 'text';
            amountInput.name = 'amount[]';
            amountInput.id = 'amount';
            amountInput.className = 'form-control';
            amountInput.readOnly = true;
            cell6.appendChild(amountInput);

            //delete
            var cell8 = row.insertCell(8);
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

        // Call the addInvoiceItem() function once to add the first row with serial number 1
        addInvoiceItem();
    </script>
@endsection
