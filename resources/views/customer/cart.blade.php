@extends('customer.layouts.master')
@section('title', 'Cart list')
@section('cssStyle')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
@endsection
@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cart List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div style="width: 49%;float: left;padding-left:1%;">
                    <h3>Shopping Cart</h3>
                </div>
                <div style="width: 50%;float: left;text-align:right">
                    <a href="{{ route('customer.products.index') }}" class="btn btn-primary mb-2 text-right">Add
                        Product to shopping cart
                    </a>
                </div>
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->

                        <div class="card-body">

                            <table id="" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="{{ route('customer.updateCart') }}" method="post">
                                        @csrf
                                        @foreach ($cart as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset($item->options->image === null ? 'images/user.png' : $item->options->image) }}"
                                                        style="height:50px;width:50px">
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <input type="number" style="width: 20%;" value="{{ $item->qty }}"
                                                        name="quantity[]">
                                                    <input type="hidden" name="row_id[]" value="{{ $item->rowId }}">
                                                </td>
                                                <td>৳{{ $item->price }}</td>
                                                <td>
                                                    <a href="{{ route('customer.removeFromCart', $item->rowId) }}"
                                                        class="text-danger">
                                                        <b>X</b>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="border: none">
                                            @if (Cart::count() > 0)
                                                <button type="submit" class="btn btn-dark">Update Cart</button>
                                            @endif
                                        </th>
                                        <th style="border: none"></th>
                                        <th style="border-top: 3px solid">Total</th>
                                        <th style="border-top: 3px solid"></th>
                                        <th style="border-top: 3px solid">৳{{ $total }}/=</th>
                                    </tr>
                                    </form>
                                    <tr>
                                        <th style="border: none"></th>
                                        <th style="border: none"></th>
                                        <td style="border:none">Extara Discount:(৳)</td>
                                        <td style="border:none"></td>
                                        <td style="border:none">
                                            ৳<input type="number" style="width: 20%;" id="discount"
                                                value="{{ $discount }}">
                                            <input type="hidden" id="total" value="{{ $total }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border: none"></th>
                                        <th style="border: none"></th>
                                        <th style="border-top: 3px solid whitesmoke">Subtotal</th>
                                        <th style="border-top: 3px solid whitesmoke"></th>
                                        <th style="border-top: 3px solid whitesmoke">৳<span
                                                id="subtotal">{{ $subtotal }}</span>/=</th>
                                    </tr>
                                    <tr></tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <a href="{{ route('customer.checkout') }}" class="btn btn-primary btn-sm btn-block">Proceed to Checkout</span></a>
                                        </th>
                                    </tr>
                                </tfoot>
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
@section('jsScript')
    <script>
        $(document).ready(function() {
            $("#discount").keyup(function() {
                var total = $("#total").val();
                var discount = $("#discount").val();
                var subtotal = total - discount;
                $("#subtotal").html(subtotal);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',

                    url: "{{ asset('/') }}customer/add-to-cart/discount",
                    data: {
                        discount: discount,
                        subtotal: subtotal,
                    },
                    cache: false,
                    async: false,
                    error: function(error) {

                    }
                })
            });
        });
    </script>
    <script>
        function add_to_cart(product_id) {

            $(document).ready(function(e) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',

                    url: "{{ asset('/') }}customer/add-to-cart",
                    data: {
                        id: product_id,
                    },
                    cache: false,
                    success: function(response) {
                        //  window.location.reload();
                        if (response.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: 'Product added to cart successfully'
                            })


                            $('.total_cart_items').html(response.cart_count);
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Product out of stock'
                            })
                        }
                        $('.total_cart_items').html(response.cart_count);
                        $('.total_cart_subtotal').html(response.cart_subtotal);

                    },
                    async: false,
                    error: function(error) {

                    }
                })
            })

        }
    </script>
@endsection
