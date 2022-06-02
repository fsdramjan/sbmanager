@extends('customer.layouts.master')
@section('title', SHOP()->name)
@section('cssStyle')

@endsection
@section('backend')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success p-5" style="">
                            <h4>
                                Name: <b>{{ $due->due_to_name }}</b><br>
                                Mobile: <b>{{ $due->due_to_phone }}</b><br>
                                <b>
                                    @if ($due_status > 0)
                                        Total Due: ৳{{ $due_status }}
                                    @else
                                        Total Deposit: ৳{{ abs($due_status) }}
                                    @endif
                                </b>
                            </h4>
                            <br>
                            <p class="d-flex justify-content-between" style="border-top: 1px solid white;">
                                <b>Due Payment Date:</b>
                                <b>{{ $due->dueDetails[($due->dueDetails->count() - 1)]->created_at->format('l m Y, H:i:s A') }}</b>
                            </p>
                        </div>
                        <section class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-4">
                                        <a href="{{ route('customer.due.showDueDeposit', [$due->id, 'plus']) }}"
                                            class="btn btn-danger btn-sm btn-block">Set Another Due</a>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="{{ route('customer.due.showDueDeposit', [$due->id, '-']) }}"
                                            class="btn btn-success btn-sm btn-block">Set Another Deposit</a>
                                    </div>
                                </div><!-- /.container-fluid -->
                            </div>
                        </section>
                        <div class="card-body">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Due Information</th>
                                        <th>Amount</th>
                                        <th>Due Mode</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($due->dueDetails as $details)
                                        <tr>
                                            <td style="vertical-align: middle;">
                                                <span>{{ $details->created_at->format('l m Y') }}</span>
                                                <br>
                                                <span>{{ $details->created_at->format('H:i:s A') }}</span>
                                            </td>
                                            <td style="vertical-align: middle;">৳
                                                {{ number_format($details->amount, 2) }}</td>
                                            <td style="vertical-align: middle;">
                                                <button class="btn btn-{{ $details->b_c }} btn-xs"
                                                    style="width: 100%;letter-spacing: 2px;">
                                                    {{ $details->due_type }} </button>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle btn-block"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('customer.due.edit', $details) }}">Edit</a>
                                                        <form action="{{ route('customer.due.delete', $details) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="dropdown-item" type="submit"
                                                                onclick="return(confirm('Are you sure want to delete this item?'))">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

@endsection
