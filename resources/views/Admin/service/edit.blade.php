@extends('layouts.auth')
@section('content')
    <form method="POST" action="{{ url('admin/services/' . $service->id) }}">
        @csrf
        @method('PUT')

        <div class="container register-form">
            <div class="form">
                <div class="note"
                    style=" text-align: center;
                height: 80px;
                background: -webkit-linear-gradient(left, #a200ff, #c51111);
                color: #fff;
                font-weight: bold;
                line-height: 80px;">
                    <p>Edit service details.</p>
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
                                    placeholder="Service Name *" value="{{ $service->name }}" required />
                            </div>
                            <div class="form-group">
                                <span class="form-label">Price</span>
                                <input type="text" name="price" class="form-control" id="price"
                                    placeholder="Price *" value="{{ $service->price }}" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <span class="form-label">HSN Code</span>
                                <input type="text" name="HSN_code" class="form-control" id="HSN_code"
                                    placeholder="HSN Code *" value="{{ $service->HSN_code }}" required />
                            </div>
                            <div class="form-group">
                                <span class="form-label">tax_rate</span>
                                <input type="text" name="tax_rate" class="form-control" id="tax_rate"
                                    placeholder="tax_rate *" value="{{ $service->tax_rate }}" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span class="form-label">Description</span>
                                <input type="text" name="description" class="form-control" id="description"
                                    placeholder="Description *" value="{{ $service->description }}" />
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
                    color: #fff;">Update</button>

                    <a href="{{ url('admin/services') }}"class="btn btn-secondary "
                        style="  border:none;
                    border-radius:1.5rem;
                    padding: 1%;
                    width: 20%;
                    cursor: pointer;
                    background: #cc0000;
                    color: #fff;">Cancel</a>
                </div>
            </div>

    </form>
@endsection
