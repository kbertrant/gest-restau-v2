<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'La marmite dorée') }} @yield('title')</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!--external css-->
    <!-- Custom styles for this template -->
    <style>
        
        html, body {
            background-image:url("../img/fond_gestion_resto_fb.png");
        }
    </style>
    @yield('stylesheets')
</head>
<body id="page-top">
     <!-- Page Wrapper -->
  <div id="wrapper">
        @include('inc.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            @include('inc.header')
            <div class="container-fluid">
            @yield('main-content')
          </div>
        
        </div>
        
    </div>
    @include('inc.footer')
</body>
    
     <!-- Bootstrap core JavaScript-->
     <script src="{{ asset('js/jquery.js') }}"></script>
     <script src="{{ asset('dist/Chart.min.js') }}"></script>
    <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    
    <script>
        var url = "{{ route('changeLang') }}";
        $(".changeLang").change(function(){
            window.location.href = url + "?lang="+ $(this).val();
        });
        $('#exampleModalLg').on('shown.bs.modal', function () {
           $('#myInput').trigger('focus')
        })
        $(function () {
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>

    @yield('scripts')


</html>
