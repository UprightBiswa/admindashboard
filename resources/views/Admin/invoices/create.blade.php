@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create Invoice
                        <a href="{{ url('admin/invoices') }}" class=" btn btn-outline-danger btn-sm  float-end">BACK</a>
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ url('admin/invoices') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="customer_id">Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-control ">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    <span>
                                        <p style="font-size: 16px; color: #000;">
                                            <a href="{{ url('admin/customers/create') }}"
                                                style="font-size: 16px; color: #000;">
                                                <span style="font-family: Arial; font-weight: bold;">+</span> Add Customer
                                            </a>
                                        </p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label for="payment_status">Payment status</label>
                                    <select id="payment_status" name="payment_status" class="form-control">
                                        @foreach ($paymentOptions as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="form-group" style="margin-right:0">
                                    <label for="issue_date">Issue Date</label>
                                    <input type="date" name="issue_date" id="issue_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group" style="margin-right:0">
                                    <label for="expiry_date">Expiry Date</label>
                                    <input type="date" name="expiry_date" id="expiry_date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h3>invoice Items</h3>
                        <div id="invoice-items">
                            <div>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <input type="text" name="descriptions[]" id="descriptions"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <select name="service_id[]" id="service_id"
                                                    class="form-control service-select">
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="quantity[]" id="quantity" class="form-control"  oninput="calculateAmount(this)">
                                            </td>
                                            <td>
                                                <input type="text" name="rate[]" id="rate" class="form-control" oninput="calculateAmount(this)">
                                            </td>
                                            <td>
                                                <input type="text" name="tax_rate[]" id="tax_rate" class="form-control" oninput="calculateAmount(this)">
                                            </td>
                                            <td>
                                                <input type="text" name="discount[]" id="discount" class="form-control" oninput="calculateAmount(this)">
                                            </td>
                                            <td>
                                                <input type="text" name="amount[]" id="amount" class="form-control" readonly>
                                            </td>

                                            <td>
                                                <button class="mdi btn-inverse-danger" id="btn_id"
                                                    onclick="deleteRow(event)">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="button" class="mdi btn-inverse-success " onclick="addInvoiceItem()">+Add New</button>
                        <hr>
                        <button type="submit" class="mdi btn-inverse-primary">Create invoice</button>
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
        var cur_count = 1

        function addInvoiceItem() {
            var invoiceItems = document.getElementById('invoice-items');

            // Get the table and the tbody elements
            var table = invoiceItems.getElementsByTagName('table')[0];
            var tbody = table.getElementsByTagName('tbody')[0];

            // Create a new row
            var newRow = document.createElement('tr');

            // Create a serial number cell
            var serialNumberCell = document.createElement('td');
            serialNumberCell.textContent = tbody.rows.length + 1;
            newRow.appendChild(serialNumberCell);

            // Create a description cell
            var descriptionCell = document.createElement('td');
            descriptionCell.innerHTML = '<input type="text" name="descriptions[]" class="form-control">';
            newRow.appendChild(descriptionCell);

            // Create a service cell with a dropdown of service names
            var serviceCell = document.createElement('td');
            var serviceDropdown = document.createElement('select');
            serviceDropdown.setAttribute('name', 'service_id[]');
            serviceDropdown.setAttribute('class', 'form-control');
            @foreach ($services as $service)
                var option = document.createElement('option');
                option.setAttribute('value', '{{ $service->id }}');
                option.textContent = '{{ $service->name }}';
                serviceDropdown.appendChild(option);
            @endforeach
            serviceCell.appendChild(serviceDropdown);
            newRow.appendChild(serviceCell);

            // Create a quantity cell
            var quantityCell = document.createElement('td');
            var quantityInput = document.createElement('input');
            quantityInput.setAttribute('type', 'text');
            quantityInput.setAttribute('name', 'quantity[]');
            quantityInput.setAttribute('class', 'form-control');
            quantityInput.setAttribute('oninput', 'calculateAmount(this)');
            quantityCell.appendChild(quantityInput);
            newRow.appendChild(quantityCell);

            // Create a rate cell
            var rateCell = document.createElement('td');
            var rateInput = document.createElement('input');
            rateInput.setAttribute('type', 'text');
            rateInput.setAttribute('name', 'rate[]');
            rateInput.setAttribute('class', 'form-control');
            rateInput.setAttribute('oninput', 'calculateAmount(this)');
            rateCell.appendChild(rateInput);
            newRow.appendChild(rateCell);

            // Create a tax_rate cell
            var tax_rateCell = document.createElement('td');
            var tax_rateInput = document.createElement('input');
            tax_rateInput.setAttribute('type', 'text');
            tax_rateInput.setAttribute('name', 'tax_rate[]');
            tax_rateInput.setAttribute('class', 'form-control');
            tax_rateInput.setAttribute('oninput', 'calculateAmount(this)');
            tax_rateCell.appendChild(tax_rateInput);
            newRow.appendChild(tax_rateCell);

            // Create a discount cell
            var discountCell = document.createElement('td');
            var discountInput = document.createElement('input');
            discountInput.setAttribute('type', 'text');
            discountInput.setAttribute('name', 'discount[]');
            discountInput.setAttribute('class', 'form-control');
            discountInput.setAttribute('oninput', 'calculateAmount(this)');
            discountCell.appendChild(discountInput);
            newRow.appendChild(discountCell);

            // Create a amount cell
            var amountCell = document.createElement('td');
            var amountInput = document.createElement('input');
            amountInput.setAttribute('type', 'text');
            amountInput.setAttribute('name', 'amount[]');
            amountInput.setAttribute('class', 'form-control');
            amountInput.setAttribute('readonly', 'readonly');
            amountCell.appendChild(amountInput);
            newRow.appendChild(amountCell);

            // Create a delete button cell
            var deleteButtonCell = document.createElement('td');
            var deleteButton = document.createElement('button');
            deleteButton.setAttribute('type', 'button');
            deleteButton.setAttribute('class', 'mdi btn-inverse-danger');
            deleteButton.setAttribute('onclick', 'deleteRow(this)');
            deleteButton.textContent = 'Delete';
            deleteButtonCell.appendChild(deleteButton);
            newRow.appendChild(deleteButtonCell);

            // Add the new row to the table
            tbody.appendChild(newRow);
        }

        function deleteRow(button) {
            // Get the row to be deleted
            var row = button.parentNode.parentNode;

            // Get the table body
            var tbody = row.parentNode;

            // Remove the row from the table
            tbody.removeChild(row);

            // Update the serial numbers of the remaining rows
            var rows = tbody.getElementsByTagName('tr');
            for (var i = 0; i < rows.length; i++) {
                rows[i].getElementsByTagName('td')[0].textContent = i + 1;
            }
        }
    </script>
@endsection
