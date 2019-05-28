<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.head')
<body>
<div class="app header-info-gradient side-nav-dark">
    <div class="layout">
        @include('admin.layouts.header')
        @include('admin.layouts.side_menu')

        <div class="page-container">
            <!--Content-->
        @yield('content')
        <!--./Content -->
            <!-- Footer START -->
            <footer class="content-footer">
                <div class="footer">
                    <div class="copyright">
                        <span>Copyright © 2018 <b class="text-dark">HungPhamHoang</b>. All rights reserved.</span>
                        <span class="go-right">
                                <a href="#" class="text-gray m-r-15">Term &amp; Conditions</a>
                                <a href="#" class="text-gray">Privacy &amp; Policy</a>
                            </span>
                    </div>
                </div>
            </footer>
            <!-- Footer END -->
        </div>
    </div>
</div>
</body>
@include('admin.layouts.script')
@yield('inline_scripts')
</html>
