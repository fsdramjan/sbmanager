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
                    <h1>Update Quick Sell</h1>
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
                            <form action="{{ route('customer.updateQuicksell', $order->id) }}" method="POST"
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
                                        @if ($order->receipt !== null)
                                            <img src="{{ asset($order->receipt) }}" style="height:20px;width:20px;">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="subtotal"
                                        value="{{ $order->subtotal }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="note" value="{{ $order->note }}"
                                        placeholder="Enter selling note">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="profit" value="{{ $order->profit }}"
                                        placeholder="Enter profit">
                                </div>
                                <div class="form-group consumer_body">
                                    <select class="form-control  select2bs4" style="width: 100%;" name="consumer_id">
                                        <option value="">--select consumer--</option>
                                        @foreach ($consumers as $consumer)
                                            <option value="{{ $consumer->id }}"
                                                @if ($order->consumer_id === $consumer->id) selected @endif>
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
