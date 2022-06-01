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
                    <h1>Due Book</h1>
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
                        <div class="card-header bg-success" style="height: 10%;vertical-align: middle;text-align:center;">
                            <h2>
                                <b>Total Due</b>
                            </h2>
                            <br>
                            <h2>
                                <b>৳ {{ 'number_format($total_transaction, 2)' }}</b>
                            </h2>
                        </div>
                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Consumer Information</th>
                                        <th>Amount</th>
                                        <th>Due Mode</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dues as $due)
                                        <tr>
                                            <td style="vertical-align: middle;">
                                                <span>#{{ $due->id }}</span>
                                                <br>
                                                {{-- @if ($due->consumer_id !== null)
                                                    <b>{{ GET_CONSUMER_BY_ID($due->consumer_id)->name }}</b>
                                                    <br>
                                                @endif --}}
                                                <b>{{ $due->due_to_name }}</b>
                                                <span>{{ $due->created_at }}</span>

                                            </td>
                                            <td style="vertical-align: middle;">৳
                                                {{ 'number_format($due->subtotal, 2)'.$due->due_to }}</td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                pp
                                            </td>
                                            <td style="vertical-align: middle;text-align:center;">
                                                {{-- <a href="{{ route('customer.transactionDetails', $due->id) }}"
                                                    class="btn btn-dark">
                                                    VIEW DETAILS
                                                </a> --}}
                                                pp
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $dues->links() }}
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
