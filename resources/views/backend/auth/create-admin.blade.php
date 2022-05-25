@extends('backend.layouts.master')
@section('title', 'Create Admin')
@section('cssLink')
@endsection
@section('cssStyle')
@endsection

@section('backend')
    <div class="">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('admin.dashboard') }}" class="h1">
                    Career<b> ProBD</b>
                </a>
            </div>
            <div class="card-body" style="width: 80%;margin:auto;">
                <p class="login-box-msg">Register a new membership</p>

                <form action="{{ route('admin.storeAdmin') }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Full name" name="name">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Phone Number" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="image">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <textarea type="text" class="form-control" placeholder="Address" name="address"></textarea>
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
                                            <input type="checkbox" id="admin" name="admin_user" value="1">
                                            <label for="admin">
                                                Admin
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="company_info" name="company" value="1">
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
                                            <input type="checkbox" id="product" name="product" value="1">
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
                                            <input type="checkbox" id="main_menu" name="main_menu" value="1">
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
                                            <input type="checkbox" id="collection" name="collection" value="1">
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
                                            <input type="checkbox" id="order_history" name="order_history" value="1">
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
                                            <input type="checkbox" id="offer" name="offer" value="1">
                                            <label for="offer">
                                                Offer
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> --}}


                    <div class="row">
                        <div class="col-8">
                            {{-- <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div> --}}
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection

@section('jsSource')
@endsection
@section('jsScript')
@endsection
