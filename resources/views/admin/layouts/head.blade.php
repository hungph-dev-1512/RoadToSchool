<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('assets/admin/vendor/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/vendor/PACE/themes/blue/pace-theme-minimal.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/vendor/perfect-scrollbar/css/perfect-scrollbar.min.css') }}" rel="stylesheet"/>

    {{-- custom css --}}
    @yield('inline_styles')

    <link href="{{ asset('assets/admin/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/materialdesignicons.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/themify-icons.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/animate.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/admin/css/app.css') }}" rel="stylesheet"/>
</head>
