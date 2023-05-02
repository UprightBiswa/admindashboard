@extends('layouts.auth')

@section('content')

{{-- <h1>New Quotation</h1>

<form action="{{ url('admin/quotations') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="customer_id">Customer:</label>
        <select name="customer_id" id="customer_id" class="form-control">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form> --}}


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Quotation') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('admin/quotations') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name">{{ __('Company Name') }}</label>
                                    <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autofocus>

                                    @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="company_address">{{ __('Company Address') }}</label>
                                    <input id="company_address" type="text" class="form-control @error('company_address') is-invalid @enderror" name="company_address" value="{{ old('company_address') }}" required>

                                    @error('company_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="company_logo">{{ __('Company Logo') }}</label>
                                    <input id="company_logo" type="file" class="form-control-file @error('company_logo') is-invalid @enderror" name="company_logo">

                                    @error('company_logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="invoice_number">{{ __('Invoice Number') }}</label>
                                    <input id="invoice_number" type="text" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{ old('invoice_number') }}" required>

                                    @error('invoice_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="bill_to">{{ __('Bill To') }}</label>
                                    <textarea id="bill_to" class="form-control @error('bill_to') is-invalid @enderror" name="bill_to" rows="4" required>{{ old('bill_to') }}</textarea>

                                    @error('bill_to')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="invoice_date">{{ __('Invoice Date') }}</label>
                                    <input id="invoice_date" type="date" class="form-control @error('invoice_date') is-invalid @enderror" name="invoice_date" value="{{ old('invoice_date') }}" required>

                                    @error('invoice_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="item_name">Item Name</label>
                                    <input type="text" class="form-control" id="item_name" name="item_name[]">
                                </div>
                                <div class="form-group">
                                    <label for="item_quantity">Quantity</label>
                                    <input type="number" class="form-control" id="item_quantity" name="item_quantity[]">
                                </div>
                                <div class="form-group">
                                    <label for="item_rate">Rate</label>
                                    <input type="number" step="0.01" class="form-control" id="item_rate" name="item_rate[]">
                                </div>
                                <div class="form-group">
                                    <label for="item_amount">Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="item_amount" name="item_amount[]" readonly>
                                </div>
                                <button type="button" class="btn btn-danger remove-btn">Remove Item</button> --}}


{{-- --- --}}


    <div class="container">
        <h1>Create Quotation</h1>
        <form action="{{ url('admin/quotations') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="customer_id">Customer</label>
                <select name="customer_id" id="customer_id" class="form-control">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control">
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
                <div class="form-group">
                    <label for="quantity">Descriptions</label>
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
                    <label for="rate">Tax</label>
                    <input type="tex" name="tax[]" id="tax" class="form-control">
                </div>
                <div class="form-group">
                    <label for="rate">Total Amount</label>
                    <input type="text" name="amount[]" id="amount" class="form-control">
                </div>
            </div>
            <button type="button" class="btn btn-success" onclick="addQuotationItem()">Add Item</button>
            <hr>
            <button type="submit" class="btn btn-primary">Create Quotation</button>
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
    </script>


{{--<section class="pb-4">
    <div class="bg-white border rounded-5">
    <div class="invoice-theme-wrapper mx-5">
        <div class="main-invoice-wrap">
            <div class="invoice-theme-1 process step-1" style="display: block;">
                <div class="invoice-block-1" style="display: flex;justify-content: space-between;align-items: center;">
                    <div class="invoice-txt" style="font-size: 2.5rem;font-weight: bold;color: #676767;">
                        <span>INVOICE</span>
                    </div>
                </div>
                <div class="invoice-block-2" style="display: flex;justify-content: space-between;align-items: center;">
                    <div class="company-details" style="width: 40%;position: relative;">
                        <div class="company-name">
                            <input type="text" id="user-company" maxlength="200" name="user_company" placeholder="Your Company Name" style="border: 1px solid #6A6A6A;padding: 0 10px;width: 100%;height: 40px;
    border-radius: 5px;margin: 10px 0;">
                        </div>
                        <div class="company-addr">
                            <textarea rows="4" id="user-company-addr" maxlength="1000" name="user_addr" placeholder="Company Address" style="border: 1px solid #6A6A6A;height: 70px;padding: 0 10px;
                                        width: 100%;border-radius: 5px;margin: 10px 0;resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 0em; width:40%">
                        <div class="custom-file col-4">
                            <img id="logo-image" width="150" height="120" style="display: none; padding-bottom:10px;">
                            <div style="border: 1px dashed; padding-top: 1em; padding-bottom: 1em; text-align: center; background-color: rgb(247, 247, 247); border-radius: 5px; color: rgb(103, 103, 103); display: block;" id="file-div">
                                <label for="file" style=" font-size: 15px;" id="file-placeholder"><b><i class="fa fa-picture-o" aria-hidden="true" style="font-size: 30px"></i><br>Add your company's logo (100x80
                                        px)</b></label>
                                <input type="file" accept="image/jpeg, image/png" name="file" id="file" style="display: none; padding-bottom:10px" onchange="loadFile(event)">
                            </div>
                        </div>
                        <div class="invoice-serial col-4" style="margin-top:1em;">
                            <div class="serial-no-invoice"><span>#</span></div>
                            <input type="text" class="invoice-number" maxlength="25" name="invoice_no" placeholder="Invoice no.">
                        </div>
                    </div>
                </div>
                <p class="bill-txt">Bill To:</p>
                <div class="invoice-block-3">
                    <div class="customer-details" style="width: 40%;position: relative;">
                        <div class="cust-details">
                            <div class="cust-name">
                                <input type="text" id="customer-name" maxlength="200" name="cust_name" placeholder="Customer's Name" style="border: 1px solid #6A6A6A;padding: 0 10px;width: 100%;height: 40px;
    border-radius: 5px;margin: 10px 0;">
                            </div>
                            <div class="cust-addr">
                                <textarea id="customer-addr" maxlength="1000" name="cust_addr" placeholder="Customer Address" style="border: 1px solid #6A6A6A;height: 70px;padding: 0 10px;
                                            width: 100%;border-radius: 5px;margin: 10px 0;resize: none;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="cust-invoice-date">
                        <div class="date">
                            <label for="inv-date" class="invoice-generator-form-label"> Date :</label> <input type="date" name="inv-date" id="inv-date" value="2023-05-02">
                        </div>
                        <div class="due-date">
                            <label for="due-date" class="invoice-generator-form-label"> Due Date:</label> <input type="date" name="due-date" id="due-date" min="2023-05-02">
                        </div>
                    </div>
                </div>
                <div class="product-details">
                    <table class="product-table">
                        <thead>
                            <tr><th width="5%">S.N.</th>
                            <th width="40%">Item</th>
                            <th width="12%">Quantity</th>
                            <th width="20%">Rate</th>
                            <th width="20%">Amount</th>
                            <th width="3%"></th>
                        </tr></thead>
                        <tbody>
                            <tr class="items-list">
                                <td class="serial_no">1</td>
                                <td>
                                    <input type="text" id="pr-name" maxlength="200" name="pr[0][name]" placeholder="Add Item">
                                </td>
                                <td>
                                    <input type="number" id="pr-qty" name="pr[0][qty]" placeholder="0" class="text-right" min="0">
                                </td>
                                <td class="rate">
                                    <span class="currency-change type-inr">₹ </span>
                                    <input type="number" id="pr-rate" name="pr[0][rate]" placeholder="0.00" class="text-right" min="0" data-val="">
                                </td>
                                <td class="amount">
                                    <span class="currency-change type-inr">₹ </span>
                                    <input type="number" id="pr-amount" name="pr[0][amount]" placeholder="0.00" class="text-right" min="0" data-val="33" data-gtm-form-interact-field-id="0">
                                </td>
                                <td class="remove-item" style="font-size: 20px; font-weight: bold; cursor: pointer;"><i class="far fa-times-circle"></i></td>
                            </tr>

                        </tbody>
                    </table>
                    <button id="addrowitem">+ Add Item</button>
                    <h3 class="head-txt width-40">Does your invoice include GST?</h3>
                    <div class="row">
                        <div class="col-6">
                            <input type="radio" id="yes" name="gst" value="yes" style="display: block; width: auto;" data-gtm-form-interact-field-id="1">
                            <label for="yes">Yes</label>
                            <input type="radio" id="no" name="gst" value="no" style="display: block; width: auto;" checked="" data-gtm-form-interact-field-id="2">
                            <label for="no">No</label>
                        </div>
                        <div class="col-6">
                            <div class="total-amount-wrap border-box" id="gst-div" style="margin-top: -20px;"><span>GST %: &nbsp;&nbsp;</span><input type="number" name="gst" id="gst" placeholder="0.00%" min="0" data-gtm-form-interact-field-id="3"> </div>
                            <input type="hidden" id="amount-without-gst" name="amount-without-gst" value="33.00">
                        </div>
                    </div>
                    <div class="total-amount-wrap border-box"><span>Total : &nbsp;&nbsp;</span><span class="currency-total">₹</span> <input type="number" name="total_amt" id="total-amount" placeholder="00.00" min="0" readonly=""> </div>
                </div>
                <div class="other-notes">
                    <div class="notes-wrap">
                        <label class="head-txt width-40 invoice-generator-form" for="inv-gen-form-notes">Notes:</label>
                        <textarea name="notes_desc" maxlength="2000" class="desc-notes border-box mt-3" id="inv-gen-form-notes"></textarea>
                    </div>
                    <div class="tnc-wrap">
                        <label class="head-txt width-40 invoice-generator-form active" for="inv-gen-form-terms">Terms &amp;
                            Conditions:</label>
                        <textarea name="tnc_desc" maxlength="2000" class="desc-tnc border-box mt-3" id="inv-gen-form-terms">Thanks for doing business with us !</textarea>
                    </div>
                </div>
            </div>
            <div class="choose-template process step-2">
                <div id="slider">
                    <div id="slider-nav">
                        <a href="#" data-slide="0" data-theme="1" class="current">Preview</a>


                    </div>
                    <div id="slider-wrapper">
                        <div class="slide">
                            <div id="content" style="width: 90%;"></div>
                        </div>



                    </div>
                </div>
            </div>
            <div class="share-n-download process step-3">
                <p class="msg-txt">Yay! Your Invoice is ready. Choose one of the following options:</p>
                <div class="share-dwnld-options">
                    <div class="options-block send-invoice">
                        <i class="fas fa-paper-plane"></i>
                        <p>Send</p>
                    </div>
                    <div class="options-block download-invoice">
                        <i class="fas fa-file-pdf"></i>
                        <p>Download</p>
                    </div>
                    <div class="options-block printe-invoice">
                        <i class="fas fa-print"></i>
                        <p>Print</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="next-button">
            <button type="button" id="prev-option" disabled="disabled">Previous</button>
            <button type="button" class="next-step" id="next-option">Next</button>
        </div>
    </div>

    </div>
    </section> --}}





  @endsection
