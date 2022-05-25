<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('backend/fontawesome-free/css/all.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/select2-bootstrap4.min.css') }}">

    @yield('cssLink')

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/css/adminlte.min.css') }}">

    @yield('cssStyle')
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('backend.layouts.partials._navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('backend.layouts.partials._sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('backend')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        @include('backend.layouts.partials._control-sidebar')
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('backend.layouts.partials._footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
    {{-- laravel sweet alert package link --}}
    @include('sweetalert::alert')

    @yield('jsSource')
    <!-- Summernote -->
    <script src="{{ asset('backend/summernote/summernote-bs4.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/js/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/js/buttons.colVis.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('backend/js/select2.full.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('backend/js/adminlte.min.js') }}"></script>

    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()
            $('#summernote1').summernote()
            $('#summernote2').summernote()
            $('#summernote3').summernote()
            $('#summernote4').summernote()
        })
    </script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                allowClear: true
            });
        });
    </script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "paging": false,
                "info": false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    {{-- <script>
        $(function() {
            var url = window.location;
            // for single sidebar menu
            $('ul.nav-sidebar a').filter(function() {
                return this.href == url;
            }).addClass('active');

            // for sidebar menu and treeview
            $('ul.nav-treeview a').filter(function() {
                    return this.href == url;
                }).parentsUntil(".nav-sidebar > .nav-treeview")
                .css({
                    'display': 'block'
                })
                .addClass('menu-open').prev('a')
                .addClass('active');
        });
    </script> --}}

    @yield('jsScript')
</body>

</html>
