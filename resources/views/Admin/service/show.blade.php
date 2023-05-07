@extends('layouts.auth')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header"
                     style="text-align: center;
                            height: 80px;
                            background: -webkit-linear-gradient(left, #a200ff, #c51111);
                            color: #fff;
                            font-weight: bold;
                            line-height: 80px;">
                    <h1>{{ $service->name }}</h1>
                </div>
                <div class="card-body"
                     style="border: 1px solid #ced4da;
                            margin-bottom: 2%;">
                    <p><strong>Price:</strong> {{ $service->price }}</p>
                    <p><strong>HSN Code:</strong> {{ $service->HSN_code }}</p>
                    <p><strong> Tax rate(%):</strong> {{ $service->tax_rate }}</p>
                    <p><strong>Description:</strong> {{ $service->description }}</p>
                    <div class="row"
                         style="padding: 2%;">
                        <div class="col-md-4">
                            <a href="{{ url('admin/services') }}"
                               class="btn btn-secondary"
                               style="border:none;
                                      border-radius:1.5rem;
                                      padding: 1%;
                                      width: 100%;
                                      cursor: pointer;
                                      background: #0062cc;
                                      color: #fff;">Back</a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ url('admin/services/'.$service->id.'/edit') }}"
                               class="btn btn-warning"
                               style="border:none;
                                      border-radius:1.5rem;
                                      padding: 1%;
                                      width: 100%;
                                      cursor: pointer;
                                      background: #ffc107;
                                      color: #fff;">Edit</a>
                        </div>
                        <div class="col-md-4">
                            <form action="{{ url('admin/services/'.$service->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-danger"
                                        style="border:none;
                                               border-radius:1.5rem;
                                               padding: 1%;
                                               width: 100%;
                                               cursor: pointer;
                                               background: #dc3545;
                                               color: #fff;">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
