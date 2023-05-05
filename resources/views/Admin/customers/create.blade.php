@extends('layouts.auth')

@section('content')
    {{-- <div class="card">
        <div class="card-header">Create Customer</div>

        <div class="card-body">
            <form action="{{ url('admin/customers') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                </div>

                <div class="form-group">
                    <label for="gst_no">GST No.:</label>
                    <input type="text" name="gst_no" id="gst_no" class="form-control" value="{{ old('gst_no') }}">
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>

                    @endsection --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Create Customer</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('admin/customers') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone:</label>
                                            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address:</label>
                                            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="gst_no">GST No:</label>
                                            <input type="text" name="gst_no" id="gst_no" class="form-control" value="{{ old('gst_no') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a href="{{ url('admin/customers') }}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
