@extends('layouts.auth')
@section('content')
    <form method="POST" action="{{ url('admin/services') }}">
        @csrf


        <div class="container register-form">
            <div class="form">
                <div class="note"
                    style=" text-align: center;
                height: 80px;
                background: -webkit-linear-gradient(left, #a200ff, #c51111);
                color: #fff;
                font-weight: bold;
                line-height: 80px;">
                    <p>Add all service details.</p>
                </div>

                <div class="form-content"
                    style=" padding: 5%;
                border: 1px solid #ced4da;
                margin-bottom: 2%;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="form-label">Name</span>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Service Name *" value="" required />
                            </div>
                            <div class="form-group">
                                <span class="form-label">Price</span>
                                <input type="text" name="price" class="form-control" id="price"
                                    placeholder="Price *" value="" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="form-label">HSN Code</span>
                                <input type="text" name="HSN_code" class="form-control" id="HSN_code"
                                    placeholder="HSN Code *" value="" required />

                            </div>
                            <div class="form-group">
                                <span class="form-label">tax_rate </span>
                                <input type="text" name="tax_rate" class="form-control" id="tax_rate"
                                    placeholder="tax_rate *" value="" required />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span class="form-label">Description</span>
                                <input type="text" name="description" class="form-control" id="description"
                                    placeholder="Description *" value="" />

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btnSubmit"
                        style="  border:none;
                    border-radius:1.5rem;
                    padding: 1%;
                    width: 20%;
                    cursor: pointer;
                    background: #0062cc;
                    color: #fff;">Submit</button>


                    <a href="{{ url('admin/services') }}"class="btn btn-secondary "
                        style="  border:none;
                    border-radius:1.5rem;
                    padding: 1%;
                    width: 20%;
                    cursor: pointer;
                    background: #cc0000;
                    color: #fff;">Back</a>
                </div>
            </div>
        </div>

    </form>
@endsection
