@extends('layouts.auth')

@section('content')

<h1>New Quotation</h1>

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
</form>
  @endsection
