<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title')</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
        @if(isCurrentRoutes('profile/lead/{id}') || isCurrentRoutes('update/product/{id}') || isCurrentRoutes('products') || isCurrentRoutes('campaigns') || isCurrentRoutes('update/campaign/{id}'))
        <link href="{{ asset('assets/libs/summernote/summernote-bs4.css') }}" rel="stylesheet" type="text/css" />
        @endif

        <!-- App css -->
        <link href="{{ asset('assets/css/retronotify.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="topbar-dark">

        <div class="loader">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>    
        </div>

        @yield('content')

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- Third Party js-->
        <script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap-select/bootstrap-select.min.js') }}"></script>

        <!-- Summernote Editor -->
        @if(isCurrentRoutes('profile/lead/{id}') || isCurrentRoutes('update/product/{id}') || isCurrentRoutes('products') || isCurrentRoutes('campaigns') || isCurrentRoutes('update/campaign/{id}'))
        <script src="{{ asset('assets/libs/summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/form-summernote.init.js') }}"></script>
        @endif
        
        <!-- Custom scripts -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <script src="{{ asset('assets/js/retronotify.js') }}"></script>
        <script src="{{ asset('assets/js/form-ajax.js') }}"></script>
    </body>
</html>