@extends('customer.layouts.master')
@section('title', SHOP()->name)
@section('cssStyle')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('backend/css/icheck-bootstrap/icheck-bootstrap.min.css') }}">

@endsection
@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('customer.quicksell') }}"
                        class="@if (Illuminate\Support\Facades\Route::is('customer.quicksell')) btn btn-info btn-sm @else btn btn-light btn-sm apply-border @endif" style="padding: 2px 35px;font-size:20px;"><img src="{{ asset('images/sell.png') }}" style="height:27px;padding:0 10px 0 0"> Quick Sell</a>

                    <a href="{{ route('customer.products.index') }}"
                        class="@if (Illuminate\Support\Facades\Route::is('customer.products.index')) btn btn-info btn-sm @else btn btn-light btn-sm apply-border @endif" style="padding: 2px 35px;font-size:20px;"><img src="{{ asset('images/product-list-icon.png') }}" style="height:27px;padding:0 10px 0 0"> Product List</a>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('customer.storeQuicksell') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex justify-content-start">
                                    <div class="form-group mr-2">
                                        <label for="">Select Date</label>
                                        <input type="date" name="current_date" id="" class="form-control"
                                            value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Add Receipt</label>
                                        <input type="file" name="receipt" id="receipt" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="subtotal"
                                        placeholder="Enter hand cash" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="note" placeholder="Enter selling note">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="profit" placeholder="Enter profit">
                                </div>
                                <div class="form-group consumer_body">
                                    <select class="form-control  select2bs4" style="width: 100%;" name="consumer_id">
                                        <option value="">--select consumer--</option>
                                        @foreach ($consumers as $consumer)
                                            <option value="{{ $consumer->id }}">
                                                {{ $consumer->name . '(' . $consumer->phone . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Accept Payment</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
