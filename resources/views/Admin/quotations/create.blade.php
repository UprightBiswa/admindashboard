@extends('layouts.auth')

@section('content')


    {{-- <div class="container">
        <h1>Create Quotation</h1>
        <form action="{{ url('admin/quotations') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6" > <div class="form-group">
                    <label for="customer_id">Customer</label>
                    <select name="customer_id" id="customer_id" class="form-control w-50">
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div></div>
                <div class="col-md-6">  <div class="form-group " style="margin-right:0">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control w-25">
                </div></div>
            </div>

            <hr>
            <h3>Quotation Items</h3>
            <div id="quotation-items">
                <div class="form-group">
                    <label for="service_id">Service</label>
                    <select name="service_id[]" id="service_id" class="form-control">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <table id="quotation-table" class="table table-striped table table-bordered">
                        <thead style="background-color:#84B0CA ;" class="text-white">
                            <tr>
                                <th>#</th>
                                <th>Descriptions</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Tax Amount</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><input type="text" name="descriptions[]" class="form-control"></td>
                                <td><input type="text" name="quantity[]" id="quantity" class="form-control" required>
                                </td>
                                <td><input type="text" name="rate[]" class="form-control"></td>
                                <td><input type="text" name="tax[]" class="form-control"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <button onclick="addQuotationItem()">Add Item</button>
            <hr>
            <button type="submit" class="btn btn-primary">Create Quotation</button>
        </form>
    </div> --}}

    {{-- <script>
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
                    <input type="text" name="descriptions[]" id="descriptions" class="form-control">
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
                    <input type="text" name="tax[]" id="tax" class="form-control">
                </div>
            `;
            var div = document.createElement('div');
            div.innerHTML = html;
            quotationItems.appendChild(div);
        }
    </script> --}}



{{--
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
          <input type="text" name="descriptions[]" id="descriptions" class="form-control">
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
          <input type="text" name="tax[]" id="tax" class="form-control">
      </div>
      `;
  var div = document.createElement('div');
  div.innerHTML = html;
  quotationItems.appendChild(div);

  // Get the last row and add a serial number
  var rows = quotationItems.getElementsByTagName('tr');
  var lastRow = rows[rows.length - 1];
  var lastRowSerialNumber = parseInt(lastRow.querySelector('td:first-child').textContent);
  var newSerialNumber = lastRowSerialNumber + 1;

  // Create a new row with the serial number and append it to the table
  var newRow = document.createElement('tr');
  newRow.innerHTML = `
      <td>${newSerialNumber}</td>
      <td><input type="text" name="descriptions[]" class="form-control"></td>
      <td><input type="text" name="quantity[]" class="form-control"></td>
      <td><input type="text" name="rate[]" class="form-control"></td>
      <td><input type="text" name="tax[]" class="form-control"></td>
      <td></td>
      `;
  quotationItems.appendChild(newRow);
}

</script> --}}

{{--
<script>
    function addQuotationItem() {
        // Get the table and tbody elements
        var table = document.getElementById('quotation-table');
        var tbody = table.querySelector('tbody');

        // Create a new row and add it to the table body
        var newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td></td>
            <td><input type="text" name="descriptions[]" class="form-control"></td>
            <td><input type="text" name="quantity[]" class="form-control"></td>
            <td><input type="text" name="rate[]" class="form-control"></td>
            <td><input type="text" name="tax[]" class="form-control"></td>
            <td></td>
        `;
        tbody.appendChild(newRow);

        // Update the serial numbers in the table
        var rows = tbody.getElementsByTagName('tr');
        for (var i = 0; i < rows.length; i++) {
            rows[i].querySelector('td:first-child').textContent = i + 1;
        }
    }
</script> --}}


  {{-- @endsection --}}



      <div class="container">
          <h1>Create Quotation</h1>
          <form action="{{ url('admin/quotations') }}" method="POST">
              @csrf
              <div class="row">
                  <div class="col-md-6" > <div class="form-group">
                      <label for="customer_id">Customer</label>
                      <select name="customer_id" id="customer_id" class="form-control w-50">
                          @foreach($customers as $customer)
                              <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                          @endforeach
                      </select>
                  </div></div>
                  <div class="col-md-6">  <div class="form-group " style="margin-right:0">
                      <label for="date">ishuDate</label>
                      <input type="date" name="date" id="date" class="form-control w-25">
                  </div></div>
              </div>

              <hr>
              <h3>Quotation Items</h3>
              <div id="quotation-items">
                  {{-- <div class="form-group">
                      <label for="service_id">Service</label>
                      <select name="service_id[]" id="service_id" class="form-control">
                          @foreach($services as $service)
                              <option value="{{ $service->id }}">{{ $service->name }}</option>
                          @endforeach
                    </select>
                   </div> --}}
                  <div>
                  <table class="table table-striped table table-bordered">
                      <thead style="background-color:#84B0CA ;" class="text-white">
                          <tr>
                              <th>#</th>
                              <th>Descriptions</th>
                              <th>Service</th>
                              <th>Quantity</th>
                              <th>Rate</th>
                              <th>Tax Amount</th>
                              <th>Total Amount</th>
                              <th>Delete Row</th>
                          </tr>
                      </thead>
                      <tbody>
                              <tr>
                                  <td>1</td>
                                  <td> <input type="text"  name="descriptions[]" id="descriptions" class="form-control"></td>
                                  <td>
                                      <select name="service_id[]" id="service_id" class="form-control">
                                           @foreach($services as $service)
                                              <option value="{{ $service->id }}">{{ $service->name }}</option>

                                          @endforeach

                                      </select ></td>
                                  <td> <input type="text"  name="quantity[]" id="quantity" class="form-control" ></td>
                                  <td> <input type="text"  name="rate[]" id="rate" class="form-control"></td>
                                  <td> <input type="text"  name="tax[]" id="tax" class="form-control"></td>
                                  <td></td>
                                  <td><button id="btn_id" onclick="deleteRow()">Delete</button></td>


                              </tr>

                      </tbody>
                  </table>
                  </div>

              </div>
              <button type="button" class="btn btn-success" onclick="addQuotationItem()">Add Item</button>
              <hr>
              <button type="submit" class="btn btn-primary">Create Quotation</button>
          </form>
      </div>

  <script>
      var cur_count=1
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
  @foreach($services as $service)
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

  // Create a rate cell
  var rateCell = document.createElement('td');
  rateCell.innerHTML = '<input type="text" name="rate[]" class="form-control">';
  newRow.appendChild(rateCell);

  // Create a tax cell
  var taxCell = document.createElement('td');
  taxCell.innerHTML = '<input type="text" name="tax[]" class="form-control">';
  newRow.appendChild(taxCell);

  // Create a total amount cell
  var totalAmountCell = document.createElement('td');
  totalAmountCell.textContent = '';
  newRow.appendChild(totalAmountCell);

  // Create a delete button cell
  var deleteButtonCell = document.createElement('td');
  var deleteButton = document.createElement('button');
  deleteButton.setAttribute('type', 'button');
  deleteButton.setAttribute('class', 'btn btn-danger');
  deleteButton.setAttribute('onclick', 'deleteRow(this)');
  deleteButton.textContent = 'Delete';
  deleteButtonCell.appendChild(deleteButton);
  newRow.appendChild(deleteButtonCell);

  // Add the new row to the table
  tbody.appendChild(newRow);
}

  </script>

    @endsection

