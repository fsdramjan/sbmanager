@extends('backend.layouts.master')
@section('title', 'Admin List')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Backend Supportive Member</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Admin List</li>
                    </ol>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $key => $admin)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if($admin->status == 0)
                                                        <form action="{{ route('admin.activeAdmin', $admin) }}" method="post">
                                                        @csrf
                                                            <button class="dropdown-item" type="submit">Active Admin</button>
                                                        </form>
                                                        @else
                                                        <form action="{{ route('admin.inactiveAdmin', $admin) }}" method="post">
                                                        @csrf
                                                            <button class="dropdown-item" type="submit">Inactive Admin</button>
                                                        </form>
                                                        @endif
                                                        <a class="dropdown-item" href="{{ route('admin.editAdmin', $admin) }}">Edit</a>
                                                        <form action="{{ route('admin.deleteAdmin', $admin) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                            <button class="dropdown-item" type="submit" onclick="return(confirm('Are you sure want to delete this item?'))">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->phone }}</td>
                                            <td>{{ $admin->address }}</td>
                                            <td>{{ $admin->status }}</td>
                                            <td><img src="{{ asset($admin->image) }}" height="50" width="50" alt=""></td>
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
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection