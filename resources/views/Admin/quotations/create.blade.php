@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create Quotation
                        <a href="{{ url('admin/quotations') }}" class="btn btn-outline-danger btn-sm  float-end">BACK</a>
                    </h5>
                </div>

                <div class="card-body">
                    <form action="{{ url('admin/quotations') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="customer_id">Customer</label>

                                    <select name="customer_id" id="customer_id" class="form-control w-50">
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
                        <h3>Quotation Items</h3>
                        <div id="quotation-items">
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
                                            <th>amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><input type="text" name="descriptions[]" id="descriptions"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <select name="service_id[]" id="service_id" class="form-control">
                                                    @foreach ($services as $service)
                                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" name="quantity[]" id="quantity" class="form-control"
                                                    oninput="calculateAmount(this)">
                                            </td>
                                            <td>
                                                <input type="text" name="rate[]" id="rate" class="form-control"
                                                    oninput="calculateAmount(this)">
                                            </td>
                                            <td>
                                                <input type="text" name="tax_rate[]" id="tax_rate" class="form-control"
                                                    oninput="calculateAmount(this)">
                                            </td>
                                            <td>
                                                <input type="text" name="amount[]" id="amount" class="form-control"
                                                    readonly>
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
                        <button type="button" class="mdi btn-inverse-success" onclick="addQuotationItem()">Add
                            Item</button>
                        <hr>
                        <button type="submit" class="mdi btn-inverse-primary">Create Quotation</button>
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
        var cur_count = 1

        function addQuotationItem() {
            var quotationItems = document.getElementById('quotation-items');

            // Get the table and the tbody elements
            var table = quotationItems.getElementsByTagName('table')[0];
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
            var taxRateCell = document.createElement('td');
            var taxRateInput = document.createElement('input');
            taxRateInput.setAttribute('type', 'text');
            taxRateInput.setAttribute('name', 'tax_rate[]');
            taxRateInput.setAttribute('class', 'form-control');
            taxRateInput.setAttribute('oninput', 'calculateAmount(this)');
            taxRateCell.appendChild(taxRateInput);
            newRow.appendChild(taxRateCell);

            // Create an amount cell
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
