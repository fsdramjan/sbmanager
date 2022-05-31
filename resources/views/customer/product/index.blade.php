@extends('customer.layouts.master')
@section('title', 'Product list')

@section('backend')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('customer.quicksell') }}"
                        class="@if (Illuminate\Support\Facades\Route::is('customer.quicksell')) btn btn-info btn-sm @else btn btn-light btn-sm apply-border @endif" style="padding: 2px 35px;font-size:20px;"><img src="{{ asset('images/sell.png') }}" style="height:27px;padding:0 10px 0 0"> Quick Sell</a>

                    <a href="{{ route('customer.products.index') }}"
                        class="@if (Illuminate\Support\Facades\Route::is('customer.products.index')) btn btn-info btn-sm @else btn btn-light btn-sm apply-border @endif" style="padding: 2px 35px;font-size:20px;"><img src="{{ asset('images/product-list-icon.png') }}" style="height:27px;padding:0 10px 0 0"> Product List</a>
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
                        <a href="{{ route('customer.products.create') }}" class="btn btn-outline-primary">Add
                            Product
                        </a>
                        <div class="card-body table-responsive" style="height: 500px;">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Sell Now</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="d-flex justify-content-between">
                                                <a href="{{ route('customer.products.edit', $product) }}"
                                                    class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('customer.products.destroy', $product) }}"
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
                                                <img src="{{ asset($product->image === null ? 'images/user.png' : $product->image) }}"
                                                    style="height:50px;width:50px">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                <a href="javascript:;" onclick="add_to_cart({{ $product->id }})"
                                                    class="btn btn-success btn-sm">Add to Cart</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $products->links() }} --}}
                        </div>
                        <tfoot>
                            <tr>
                                <a href="{{ route('customer.cart') }}" class="btn btn-info btn-sm">
                                    <h6 style="width: 50%;text-align:left;float:left;">Total Sale</h6>
                                    <div class="d-flex justify-content-start mr-3"
                                        style="width: 10%;text-align:left;float:left;">
                                        <p>৳</p>
                                        <p class="total_cart_subtotal">
                                            {{ Cart::subtotal() }}</p>
                                    </div>
                                    <div class="d-flex justify-content-start bg-white"
                                        style="width: 5%;float:left;">
                                        <p class="total_cart_items" 
                                        style="text-align:center;">
                                            {{ Cart::count() }}</p>
                                        <p>></p>
                                    </div>
                                </a>
                            </tr>
                        </tfoot>
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
