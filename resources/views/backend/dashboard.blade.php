@extends('backend.layouts.master')
@section('title', 'dashboard')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{-- <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-chalkboard-teacher"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Approved Instructor</span>
                            <span class="info-box-number">{{ $ainatructor }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-alt-slash"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Disapproved Instructor</span>
                            <span class="info-box-number">{{ $iinatructor }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-notes-medical"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Active Courses</span>
                            <span class="info-box-number">{{ $active_course }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-notes-medical"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Inactive Courses</span>
                            <span class="info-box-number">{{ $inactive_course }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-cog"></i> </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Admin</span>
                            <span class="info-box-number">{{ $admin }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-alt"></i></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">User</span>
                            <span class="info-box-number">{{ $user }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info">
                            <i class="fas fa-shopping-bag"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Order</span>
                            <span class="info-box-number">{{ $order }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-spell-check"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Checked Assesment</span>
                            <span class="info-box-number">{{ $checked_assesment }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info">
                            <i class="fas fa-eye-slash"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Unchecked Assesment</span>
                            <span class="info-box-number">{{ $unchecked_assesment }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fab fa-steam"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Exam</span>
                            <span class="info-box-number">{{ $exam }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-md"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Job</span>
                            <span class="info-box-number">{{ $job }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-md"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Active Job</span>
                            <span class="info-box-number">{{ $active_job }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-md"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Inactive Job</span>
                            <span class="info-box-number">{{ $inactive_job }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-md"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Job Posted By Admin</span>
                            <span class="info-box-number">{{ $job_by_admin }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-md"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Job Posted By Admin</span>
                            <span class="info-box-number">{{ $job_by_user }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-user-md"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Yesterday Job Application</span>
                            <span class="info-box-number">{{ $yesterday_application }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section> --}}
    {{ Auth::guard('admin')->user()->email }}
@endsection
