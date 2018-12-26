<!DOCTYPE html>
<html lang="en">
@include('user.layouts.head')
@yield('inline_styles')
<body>
@include('user.layouts.header')
<!--Content-->
@yield('content')
<!--./Content -->
@include('user.layouts.footer')
@yield('inline_scripts')
</body>
</html>
