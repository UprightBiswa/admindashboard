@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Create Quotation
                        <a href="{{ url('admin/quotations') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ url('admin/quotations') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-3">
                                <div class="form-group" style="margin-right:0">
                                    <label for="issue_date">Issue Date</label>
                                    <input type="date" name="issue_date" id="issue_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
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
                                            <td><input type="text" name="quantity[]" id="quantity" class="form-control">
                                            </td>
                                            <td><button class="mdi mdi mdi-delete-forever" id="btn_id"
                                                    onclick="deleteRow(event)">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="button" class="mdi btn-success" onclick="addQuotationItem()">+Add Item</button>
                        <hr>
                        <button type="submit" class="btn btn-primary">Create Quotation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
            quantityCell.innerHTML = '<input type="text" name="quantity[]" class="form-control">';
            newRow.appendChild(quantityCell);


            // Create a delete button cell
            var deleteButtonCell = document.createElement('td');
            var deleteButton = document.createElement('button');
            deleteButton.setAttribute('type', 'button');
            deleteButton.setAttribute('class', 'mdi mdi mdi-delete-forever');
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
