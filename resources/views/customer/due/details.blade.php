@extends('customer.layouts.master')
@section('title', SHOP()->name)
@section('cssStyle')

@endsection
@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transaction Details</h1>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Consumer Information</th>
                                        <th>Price</th>
                                        <th>Payment Method</th>
                                        <th>Selling Mode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <span>#{{ $transaction->id }}</span>
                                            <br>
                                            @if ($transaction->consumer_id !== null)
                                                <b>{{ GET_CONSUMER_BY_ID($transaction->consumer_id)->name }}</b>
                                                <br>
                                            @endif
                                            <span>{{ $transaction->created_at }}</span>
                                        </td>
                                        <td style="vertical-align: middle;">৳
                                            {{ number_format($transaction->subtotal, 2) }}</td>
                                        <td style="vertical-align: middle;">{{ $transaction->payment_method }}</td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <button class="btn btn-primary btn-xs">PRODUCT SELL</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div style="width: 49%;float: left;padding-left:1%;">
                    <h3>Shopping Cart</h3>
                </div>
                <div style="width: 50%;float: left;text-align:right">
                    @if ($transaction->payment_method !== 'Quick Sell')
                        <a href="{{ route('customer.cartOrder', $transaction->id) }}"
                            class="btn btn-primary mb-2 text-right">Edit shopping cart
                        </a>
                    @else
                        <a href="{{ route('customer.editQuicksell', $transaction->id) }}"
                            class="btn btn-primary mb-2 text-right">Edit shopping cart
                        </a>
                    @endif
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="" class="table  table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Selling Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->orderProduct as $product)
                                        <tr>
                                            <td style="vertical-align: middle;">
                                                <img src="{{ asset(GET_PRODUCT_BY_ID($product->product_id)->image) }}"
                                                    style="height:50px;width:50px;">
                                            </td>
                                            <td style="vertical-align: middle;">
                                                {{ GET_PRODUCT_BY_ID($product->product_id)->name }}</td>
                                            <td style="vertical-align: middle;">x{{ $product->quantity }}</td>
                                            <td style="vertical-align: middle;">
                                                ৳ {{ number_format(GET_PRODUCT_BY_ID($product->product_id)->price, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td style="border: none"></td>
                                        <td style="border: none"></td>
                                        <td style="border: none">Total</td>
                                        <td style="border: none">৳ {{ number_format($transaction->total, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: none"></td>
                                        <td style="border:none"></td>
                                        <td style="border:none">Extara Discount:(৳)</td>
                                        <td style="border:none">
                                            ৳{{ number_format($transaction->discount, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border: none"></th>
                                        <th style="border: none"></th>
                                        <th style="border-top: 2px solid whitesmoke">Subtotal</th>
                                        <th style="border-top: 2px solid whitesmoke">৳
                                            {{ number_format($transaction->subtotal, 2) }}</th>
                                    </tr>
                                    <tr>
                                        <th style="border: none"></th>
                                        <th style="border: none"></th>
                                        <th style="border: none">Payment</th>
                                        <th style="border: none">
                                            ৳ {{ number_format($transaction->cash, 2) }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="border: none"></th>
                                        <th style="border: none"></th>
                                        <th style="border: none"></th>
                                        <th style="border: none"></th>
                                    </tr>
                                    <tr>
                                        <th style="border: none"></th>
                                        <th style="border: none"></th>
                                        <th style="border: none">Total Due</th>
                                        <th style="border: none">
                                            ৳ {{ number_format($transaction->subtotal - $transaction->cash, 2) }}
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
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
