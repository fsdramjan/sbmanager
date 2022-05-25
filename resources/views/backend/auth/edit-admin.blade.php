@extends('backend.layouts.master')
@section('title', 'Update Admin')

@section('backend')
    <div class="">
        <div class="register-logo">
            <a href="{{ route('admin.dashboard') }}" class="h1">Bazar<b>kart</b></a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Edit supportive member</p>

                <form action="{{ route('admin.updateAdmin', $admin) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ $admin->name }}" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{ $admin->phone }}" name="phone" placeholder="Phone number">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" value="{{ $admin->email }}" name="email">
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="image">
                            </div>
                            @if ($admin->image)
                                <img src="{{ asset($admin->image) }}" height="100" width="100" alt="User logo">
                            @endif
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <textarea type="text" rows="2" class="form-control" name="address" placeholder="Address">{{ $admin->address }}</textarea>
                    </div>
                    {{-- <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Respective Admin Role / Access</h3>
                        </div>
                        <div class="card-body">
                            <!-- Minimal style -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="admin" name="admin_user" value="1" @if ($admin->admin_user == 1) {{ 'checked' }} @endif>
                                            <label for="admin" >
                                                Admin
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="company_info" name="company" value="1" @if ($admin->company == 1) {{ 'checked' }} @endif>
                                            <label for="company_info">
                                                Company Info
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Minimal style -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="product" name="product" value="1" @if ($admin->product == 1) {{ 'checked' }} @endif>
                                            <label for="product">
                                                Product
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="main_menu" name="main_menu" value="1" @if ($admin->main_menu == 1) {{ 'checked' }} @endif>
                                            <label for="main_menu">
                                                Main Menu
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Minimal style -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="collection" name="collection" value="1" @if ($admin->collection == 1) {{ 'checked' }} @endif>
                                            <label for="collection">
                                                Collection
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="order_history" name="order_history" value="1" @if ($admin->order_history == 1) {{ 'checked' }} @endif>
                                            <label for="order_history">
                                                Order History
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Minimal style -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="offer" name="offer" value="1"
                                                @if ($admin->offer == 1) {{ 'checked' }} @endif>
                                            <label for="offer">
                                                Offer
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> --}}
                    <hr>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <br>
    <br>
@endsection
