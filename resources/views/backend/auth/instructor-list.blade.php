@extends('backend.layouts.master')
@section('title', 'Instructor List')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Instructor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Instructor List</li>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Approved?</th>
                                        <th>Courses?</th>
                                        <th>Created_at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instructors as $key => $instructor)
                                        <tr>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if ($instructor->is_approved === 0)
                                                            <form
                                                                action="{{ route('admin.activeInstructor', $instructor) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Active
                                                                    Instructor</button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('admin.inactiveInstructor', $instructor) }}"
                                                                method="post">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">Inactive
                                                                    Instructor</button>
                                                            </form>
                                                        @endif
                                                        {{-- <a class="dropdown-item"
                                                            href="{{ route('admin.editAdmin', $admin) }}">Edit</a>
                                                         <form action="{{ route('admin.deleteAdmin', $admin) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="dropdown-item" type="submit"
                                                                onclick="return(confirm('Are you sure want to delete this item?'))">Delete</button>
                                                        </form> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td><img src="{{ asset($instructor->image ?? '') }}" height="50" width="50"
                                                    alt=""></td>
                                            <td>{{ $instructor->name }}</td>
                                            <td>{{ $instructor->email }}</td>
                                            <td>{{ $instructor->phone }}</td>
                                            <td>{{ $instructor->is_approved === 1 ? 'Y' : 'N' }}</td>
                                            <td>
                                                Active: {{ getActiveCourseByInstructorId($instructor->id) }}
                                                <hr>
                                                Inactive: {{ getInactiveCourseByInstructorId($instructor->id) }}
                                            </td>
                                            <td>{{ $instructor->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $instructors->links() }}
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
