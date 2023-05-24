@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Customer
                        <a href="{{ url('admin/customers') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/customers') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}">
                                @if (old('name') && old('name') === old('name'))
                                    <small class="text-danger">The name "{{ old('name') }}" is already taken. Please
                                        choose a different name.</small>
                                @else
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                @endif
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}">
                                @if (old('email') && old('email') === old('email'))
                                    <small class="text-danger">The email "{{ old('email') }}" is already registered. Please
                                        enter a different email.</small>
                                @else
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone">Phone:</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    value="{{ old('phone') }}">
                                @if (old('phone') && old('phone') === old('phone'))
                                    <small class="text-danger">The phone number "{{ old('phone') }}" is already registered.
                                        Please enter a different phone number.</small>
                                @else
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                @endif
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="gst_no">GST No:</label>
                                <input type="text" name="gst_no" id="gst_no" class="form-control"
                                    value="{{ old('gst_no') }}">

                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="address">Address:</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address') }}">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('admin/customers') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
