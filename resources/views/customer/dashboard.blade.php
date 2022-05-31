@extends('customer.layouts.master')
@section('title', 'dashboard')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-notes-medical"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Today's Sale</span>
                            <span class="info-box-number">৳ {{ 0 }}</span>
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
                            <span class="info-box-text">Today's Expenses</span>
                            <span class="info-box-number">৳ {{ 0 }}</span>
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
                            <span class="info-box-text">Today's Due</span>
                            <span class="info-box-number">৳ {{ 0 }}</span>
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
                            <span class="info-box-text">Today's Balance</span>
                            <span class="info-box-number">৳ {{ 0 }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
@endsection
