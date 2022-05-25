@extends('backend.layouts.master')
@section('title', 'Company Info')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Company Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Company</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.storeCompanyInfo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">About (in a nutshell)</label>
                                    <textarea name="about" class="form-control" rows="2"
                                        placeholder="Enter about">{{ $info->about ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <textarea name="address" class="form-control" rows="2"
                                        placeholder="Enter address">{{ $info->address ?? '' }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone One</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter phone one" name="phone_one"
                                                value="{{ $info->phone_one ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone Two</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter phone two" name="phone_two"
                                                value="{{ $info->phone_two ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone Three</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Enter phone three" name="phone_three"
                                                value="{{ $info->phone_three ?? '' }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter email" name="email" value="{{ $info->email ?? '' }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Company Logo</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="logo"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                            @if (!empty($info->logo))
                                                <img src="{{ asset($info->logo) }}" height="100" width="200" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Company favicon</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" name="favicon"
                                                        id="exampleInputFile">
                                                </div>
                                            </div>
                                            @if (!empty($info->favicon))
                                                <img src="{{ asset($info->favicon) }}" height="100" width="200" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Facebook</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter facebook" name="facebook" value="{{ $info->facebook ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Twitter</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter twitter" name="twitter" value="{{ $info->twitter ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Instagram</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter instagram" name="instagram"
                                        value="{{ $info->instagram ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Youtube</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter youtube" name="youtube" value="{{ $info->youtube ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">LinkedIn</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter linkedin" name="linkedin" value="{{ $info->linkedin ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pinterest</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                        placeholder="Enter pinterest" name="pinterest"
                                        value="{{ $info->pinterest ?? '' }}">
                                </div>
                            </div>

                            <!-- /.card-body -->
                            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
