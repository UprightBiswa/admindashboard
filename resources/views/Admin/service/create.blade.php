@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Service
                        <a href="{{ url('admin/services') }}" class="btn btn-danger btn-sm text-white float-end">BACK</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/services') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Service Name *" value="{{ old('name') }}"  />
                                @if (old('name') && old('name') === old('name'))
                                    <small class="text-danger">The service name "{{ old('name') }}" is already taken.
                                        Please
                                        choose a different name.</small>
                                @else
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="price">Price:</label>
                                <input type="text" name="price" id="price" class="form-control"
                                    placeholder="Price *" value="{{ old('price') }}"  />

                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="HSN_code">HSN_code:</label>
                                <input type="text" name="HSN_code" id="HSN_code" class="form-control"
                                    placeholder="HSN Code *" value="{{ old('HSN_code') }}"  />
                                @if (old('HSN_code') && old('HSN_code') === old('HSN_code'))
                                    <small class="text-danger">The HSN_code number "{{ old('HSN_code') }}" is already
                                        registered.
                                        Please enter a different HSN_code number.</small>
                                @else
                                    @error('HSN_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                @endif
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tax_rate">tax_rate:</label>
                                <input type="text" name="tax_rate" id="tax_rate" class="form-control"
                                    placeholder="tax_rate *" value="{{ old('tax_rate') }}"  />

                                @error('tax_rate')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Description *">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('admin/services') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
