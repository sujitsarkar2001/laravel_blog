<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="icon" href="{{asset('/')}}assets/admin/favicon/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('/')}}assets/admin/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('/')}}assets/admin/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('/')}}assets/admin/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{asset('/')}}assets/admin/plugins/morrisjs/morris.css" rel="stylesheet" />

    @stack('css')
    <!-- Toastr Css -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <!-- Custom Css -->
    <link href="{{asset('/')}}assets/admin/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('/')}}assets/admin/css/themes/all-themes.css" rel="stylesheet" />

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
</head>
<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->

    <!-- Top Bar -->
    @include('layouts.admin.partials.top-bar')
    <!-- #Top Bar -->

    <!-- Sidebar -->
    @include('layouts.admin.partials.sidebar')
    <!-- #Sidebar -->

    <section class="content">
        @yield('content')
    </section>

    <!-- Jquery Core Js -->
    <script src="{{asset('/')}}assets/admin/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('/')}}assets/admin/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="{{asset('/')}}assets/admin/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('/')}}assets/admin/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('/')}}assets/admin/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="{{asset('/')}}assets/admin/js/admin.js"></script>

    <!-- Demo Js -->
    <script src="{{asset('/')}}assets/admin/js/demo.js"></script>

    <!-- Toastr Js -->
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

    <script type="text/javascript">
        @if ($errors->any() )
            @foreach ($errors->all() as $error)
               toastr.error( '{{ $error }}', 'Error', {
                    closeButton: true,
                    progressBar: true,
               });
            @endforeach
        @endif
    </script>

    @stack('js')
    
</body>
</html>