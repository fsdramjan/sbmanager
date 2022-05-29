@extends('customer.layouts.master')
@section('title', 'Cart list')
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
    <section class="content">
        <form action="{{ route('customer.placeOrder') }}" method="post">
            @csrf
            <div class="container-fluid">
                <div class="row pt-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body bg-primary" style="padding: 5px 15px;border-radius:5px;">
                                <div style="width: 70%;float:left;">
                                    <h4>
                                        Paid Amount
                                    </h4>
                                </div>
                                <div style="width: 30%;float:left;">
                                    <h4>
                                        ৳{{ $subtotal }}
                                        <input type="hidden" name="subtotal" value="{{ $subtotal }}" id="subtotal">
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="padding: 5px 15px;">
                                <div style="width: 70%;float:left;">
                                    <h4>
                                        Hand Cash
                                    </h4>
                                </div>
                                <div style="width: 30%;float:left;">
                                    ৳<input type="number" placeholder="0" name="cash" id="cash" style="width: 20%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="padding: 5px 15px;">
                                <div style="width: 70%;float:left;">
                                    <h4>
                                        Change
                                    </h4>
                                </div>
                                <div style="width: 30%;float:left;">
                                    ৳<input type="number" placeholder="0" id="change" name="change" style="width: 20%;border:none"
                                        disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Payment Method</h3>
                            </div>
                            <div class="card-body">
                                <!-- Minimal style -->
                                <div class="row">
                                    <!-- radio -->
                                    <div class="form-group" style="width: 70%;float:left;">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="handCash" name="payment_method" value="Cash" checked>
                                            <label for="handCash">
                                                Hand Cash
                                            </label>
                                        </div>
                                    </div>
                                    <div style="width:30%;float:left;">
                                        <img src="{{ asset('csash.svg') }}" alt="cash">
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <!-- radio -->
                                    <div class="form-group" style="width: 70%;float:left;">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="digital_payment" name="payment_method"
                                                value="Digital Payment">
                                            <label for="digital_payment">
                                                Digital Payment
                                            </label>
                                        </div>
                                    </div>
                                    <div style="width:30%;float:left;">
                                        <img src="{{ asset('digitel_payment.svg') }}" alt="cash">
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <!-- radio -->
                                    <div class="form-group" style="width: 70%;float:left;">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="due" name="payment_method" value="Due">
                                            <label for="due">
                                                Keep Due
                                            </label>
                                        </div>
                                    </div>
                                    <div style="width:30%;float:left;">
                                        <img src="{{ asset('due.svg') }}" alt="cash">
                                    </div>
                                </div>
                                <div class="row pt-3">
                                    <!-- radio -->
                                    <div class="form-group" style="width: 70%;float:left;">
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="personal" name="payment_method"
                                                value="Personal Payment">
                                            <label for="personal">
                                                Personal Bkash/Nagad Payment
                                            </label>
                                        </div>
                                    </div>
                                    <div style="width:30%;float:left;">
                                        <img src="{{ asset('bkash.svg') }}" alt="cash">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row pt-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control pl-5" placeholder="Comment"
                                style="    background: whitesmoke;" name="comment">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="padding: 5px 15px;">
                                <div style="width: 70%;float:left;" class="pl-4">
                                    <h4>
                                        Customer Information
                                    </h4>
                                </div>
                                <div style="width: 30%;float:left;">
                                    <input type="checkbox" onclick="consumer()" id="consumer">
                                </div>
                            </div>
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
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="padding: 5px 15px;">
                                <div style="width: 70%;float:left;" class="pl-4">
                                    <h4>
                                        Employee Information
                                    </h4>
                                </div>
                                <div style="width: 30%;float:left;">
                                    <input type="checkbox" onclick="employee()" id="employee">
                                </div>
                            </div>
                        </div>
                        <div class="form-group employee_body">
                            <select class="form-control  select2bs4" style="width: 100%;" name="employee_id">
                                <option value="">--select employee--</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">
                                        {{ $employee->name . '(' . $employee->phone . ')' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container mb-5">
                <div class="row">
                    <button type="submit" class="btn btn-primary btn-sm btn-block" style="width: 50%;margin:auto">Submit
                        Order</button>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('jsScript')

    <!-- Bootstrap Switch -->
    <script>
        $(document).ready(function() {
            $("#cash").keyup(function() {
                var subtotal = +$("#subtotal").val();
                var cash = +$("#cash").val();
                var change = cash - subtotal;
                $("#change").val(change);

            });
        });
    </script>
    <script>
        $('.consumer_body').show();
        $('.employee_body').show();

        function consumer() {
            if ($("#consumer").is(":checked")) {
                $('.consumer_body').show();
            } else {
                $('.consumer_body').hide();
            }
        }

        function employee() {
            if ($("#employee").is(":checked")) {
                $('.employee_body').show();
            } else {
                $('.employee_body').hide();
            }
        }
    </script>
@endsection
