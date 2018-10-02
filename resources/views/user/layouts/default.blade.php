<!DOCTYPE html>
<html lang="en">
    @include('user.layouts.head')
    <body>
        @include('user.layouts.header')
        <!--Content-->
        @yield('content')
        <!--./Content -->
        @include('user.layouts.footer')
        @yield('inline_scripts')
    </body>
</html>
