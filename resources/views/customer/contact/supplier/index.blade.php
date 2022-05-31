@extends('customer.layouts.master')
@section('title', 'Supplier list')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('customer.consumers.index') }}"
                        class="@if (Illuminate\Support\Facades\Route::is('customer.consumers.index')) btn btn-info btn-sm @else btn btn-light btn-sm @endif"
                        style="padding: 2px 35px;font-size:20px;">Consumer</a>

                    <a href="{{ route('customer.suppliers.index') }}"
                        class="@if (Illuminate\Support\Facades\Route::is('customer.suppliers.index')) btn btn-info btn-sm @else btn btn-light btn-sm @endif"
                        style="padding: 2px 35px;font-size:20px;">Supplier</a>

                    <a href="{{ route('customer.employees.index') }}"
                        class="@if (Illuminate\Support\Facades\Route::is('customer.employees.index')) btn btn-info btn-sm @else btn btn-light btn-sm @endif"
                        style="padding: 2px 35px;font-size:20px;">Employee</a>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('customer.suppliers.create') }}" class="btn btn-outline-primary">Add
                                Supplier
                            </a>
                            <br>
                            <br>
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Supply Product</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $supplier)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('customer.suppliers.edit', $supplier) }}"
                                                    class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('customer.suppliers.destroy', $supplier) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        onclick="return(confirm('Are you sure want to delete this item?'))"
                                                        class="btn btn-danger btn-xs"> <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <img src="{{ asset($supplier->image === null ? 'images/user.png' : $supplier->image) }}"
                                                    style="height:50px;width:50px">
                                            </td>
                                            <td>{{ $supplier->name }}</td>
                                            <td>{{ $supplier->phone }}</td>
                                            <td>{{ $supplier->email ?? 'N/A' }}</td>
                                            <td>{{ $supplier->supply_product }}</td>
                                            <td>{{ $supplier->address }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $suppliers->links() }}
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
    <!-- /.content -->
@endsection
