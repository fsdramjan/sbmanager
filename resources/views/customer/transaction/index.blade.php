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
                    <h1>Transaction List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Transaction</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success" style="height: 10%;vertical-align: middle;text-align:center;">
                            <h2>
                                <b>Total Transaction</b>
                            </h2>
                            <br>
                            <h2>
                                <b>৳ {{ number_format($total_transaction, 2) }}</b>
                            </h2>
                        </div>
                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Consumer Information</th>
                                        <th>Price</th>
                                        <th>Payment Method</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td style="vertical-align: middle;">
                                                <span>#{{ $order->id }}</span>
                                                <br>
                                                @if ($order->consumer_id !== null)
                                                    <b>{{ GET_CONSUMER_BY_ID($order->consumer_id)->name }}</b>
                                                    <br>
                                                @endif
                                                <span>{{ $order->created_at }}</span>
                                            </td>
                                            <td style="vertical-align: middle;">৳
                                                {{ number_format($order->subtotal, 2) }}</td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <button class="btn btn-{{ $order->button_color }} btn-xs"
                                                    style="width: 100%;letter-spacing: 2px;"
                                                    @if ($order->payment_method === 'Digital Payment' && $order->payment_link !== null) data-toggle="modal" data-target="#exampleModal{{ $order->id }}" @endif>
                                                    {{ $order->payment_method }} </button>
                                                @if ($order->payment_method !== 'Quick Sell')
                                                    <br>
                                                    <span>
                                                        @php
                                                            $count = 0;
                                                            foreach ($order->orderProduct as $pp) {
                                                                $count += $pp->quantity;
                                                            }
                                                        @endphp
                                                        {{ $count }} Items</span>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle;text-align:center;">
                                                <a href="{{ route('customer.transactionDetails', $order->id) }}"
                                                    class="btn btn-dark">
                                                    VIEW DETAILS
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $orders->links() }}
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

    @foreach ($orders as $order)
        @if ($order->payment_link !== null)
            <div class="modal fade" id="exampleModal{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ $order->payment_link }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

@endsection
