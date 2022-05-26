<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your shops - {{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/fontawesome-free/all.min.css') }}">
    <!-- icheck bootstrap -->
    {{-- <link rel="stylesheet" href="{{ asset('backend/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/adminlte.min.css') }}">
</head>

<body class="hold-transition bg-info">

    <!-- Just an image -->
    <div class="container-fluide bg-light" style="padding: 2rem">
        {{-- <div class="row"> --}}
        <div class="d-flex justify-content-between">
            <div>
                <img src="{{ asset($company->logo) }}" style="width:200px">
            </div>
            <div>
                <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default">Create New
                    Shop</a>
            </div>
            {{-- </div> --}}
        </div>
    </div>

    <div class="container pt-5">
        <div class="d-flex justify-content-center">
            @foreach ($shops as $shop)
                <div class="card mr-2" style="width: 13rem">
                    <img style="padding: 1rem;height:200px;width:200px;" class="card-img-top"
                        src="{{ asset($shop->image) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title" style="color: black"><b>{{ $shop->name }}</b></h5>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            <form action="{{ route('customer.dashboard') }}" method="post">
                                @csrf
                                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                                <button type="submit" class="btn btn-success btn-block">Select Shop</button>
                            </form>
                        </small>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- /.login-box -->
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content" style="color: black">
                <div class="modal-header">
                    <h4 class="modal-title">Create a new shop</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer.shop.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="formGroupExampleInput">Your shop name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="Your shop name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Shop image (200 x 200)</label>
                            <input type="file" class="form-control" id="formGroupExampleInput2" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- jQuery -->
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/js/adminlte.min.js') }}"></script>
</body>

</html>
