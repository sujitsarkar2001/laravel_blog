<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

	<!-- Stylesheets -->
	<link href="{{asset('/')}}assets/website/css/bootstrap.css" rel="stylesheet">
	<link href="{{asset('/')}}assets/website/css/swiper.css" rel="stylesheet">
	<link href="{{asset('/')}}assets/website/css/ionicons.css" rel="stylesheet">
    <!-- Toastr Css -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @stack('css')

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <!-- Header Start -->
    @include('layouts.website.partials.header')
    <!-- Header End -->

    @yield('content')

    <!-- Footer Start -->
    @include('layouts.website.partials.footer')
    <!-- Footer End -->


    <!-- SCIPTS -->
	<script src="{{asset('/')}}assets/website/js/jquery-3.1.1.min.js"></script>
	<script src="{{asset('/')}}assets/website/js/tether.min.js"></script>
	<script src="{{asset('/')}}assets/website/js/bootstrap.js"></script>
	@stack('js')
    <script src="{{asset('/')}}assets/website/js/scripts.js"></script>
    
    <!-- Toastr Js -->
    @stack('js')
    
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
</body>
</html>