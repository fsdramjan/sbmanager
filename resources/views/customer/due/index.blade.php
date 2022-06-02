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
                        <div class="card-header bg-success d-flex justify-content-between"
                            style="height: 10%;vertical-align: middle;text-align:center;">
                            <h2>
                                <b>Total Due</b>
                                <br>
                                <span>৳ {{ number_format($total_due, 2) }}</span>
                            </h2>
                            <h2>
                                <b>Total Deposit</b>
                                <br>
                                <span>৳ {{ number_format($total_deposit, 2) }}</span>
                            </h2>
                        </div>
                        <section class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h5>Consumer({{ $consumer }})/Supplier({{ $supplier }})/Employee({{ $employee }})
                                        </h5>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="{{ route('customer.due.create') }}" class="btn btn-primary btn-lg">Create
                                            New Due Book</a>
                                    </div>
                                </div>
                            </div><!-- /.container-fluid -->
                        </section>
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
                                        @if ($due->dueDetails->count() > 0)
                                            <tr>
                                                <td style="vertical-align: middle;">
                                                    <span>#{{ $due->id }}</span>
                                                    <br>
                                                    <b>{{ $due->due_to_name }}</b>
                                                    <br>
                                                    <span>{{ $due->created_at }}</span>

                                                </td>
                                                <td style="vertical-align: middle;">৳
                                                    {{ number_format($due->dueDetails->first()->amount, 2) }}</td>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <button class="btn btn-{{ $due->button_color }} btn-xs"
                                                        style="width: 100%;letter-spacing: 2px;">
                                                        {{ $due->dueDetails->first()->due_type }} </button>
                                                </td>
                                                <td style="vertical-align: middle;text-align:center;">
                                                    <a class="btn btn-primary btn-block"
                                                        href="{{ route('customer.due.show', $due) }}">View Details</a>
                                                </td>
                                            </tr>
                                        @endif
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
