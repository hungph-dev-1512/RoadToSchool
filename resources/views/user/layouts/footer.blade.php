<footer>
    <section class="footer-Content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                        <h3 class="block-title">{{ __('titles.about') }}</h3>
                        <div class="textwidget">
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                        <h3 class="block-title">{{ __('titles.links') }}</h3>
                        <ul class="menu">
                            <li><a href="#">{{ __('titles.home') }}</a></li>
                            <li><a href="#">{{ __('titles.faq') }}</a></li>
                            <li><a href="#">{{ __('titles.contact') }}</a></li>
                            <li><a href="#">{{ __('titles.notifications') }}</a></li>
                            <li><a href="#">{{ __('titles.categories') }}</a></li>
                            <li><a href="#">{{ __('titles.full_width') }}</a></li>
                            <li><a href="#">{{ __('titles.left_side_bar') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                        <h3 class="block-title">{{ __('titles.latest_tweets') }}</h3>
                        <div class="twitter-content clearfix">
                            <ul class="twitter-list">
                                <li class="clearfix">
                                    <span>
                                        <a href="#"></a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="widget">
                        <h3 class="block-title">{{ __('titles.premium_ads') }}</h3>
                        <ul class="featured-list">
                            <li>
                                <img alt="" src="{{ asset('assets/img/featured/img1.jpg') }}">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                            <li>
                                <img alt="" src="{{ asset('assets/img/featured/img2.jpg') }}">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                            <li>
                                <img alt="" src="{{ asset('assets/img/featured/img3.jpg') }}">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                            <li>
                                <img alt="" src="{{ asset('assets/img/featured/img4.jpg') }}">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                            <li>
                                <img alt="" src="{{ asset('assets/img/featured/img5.jpg') }}">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                            <li>
                                <img alt="" src="{{ asset('assets/img/featured/img6.jpg') }}">
                                <div class="hover">
                                    <a href="#"><span>$49</span></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info pull-left">
                        <p> {{ __('titles.copyright_p1') }}&copy;{{ __('titles.copyright_p2') }} <a href=""
                                                                                                    rel="nofollow">Phạm
                                Hoàng Hưng</a></p>
                    </div>
                    <div class="bottom-social-icons social-icon pull-right">
                        <a class="facebook" target="_blank" href=""><i class="fa fa-facebook"></i></a>
                        <a class="twitter" target="_blank" href=""><i class="fa fa-twitter"></i></a>
                        <a class="dribble" target="_blank" href=""><i class="fa fa-dribbble"></i></a>
                        <a class="flickr" target="_blank" href=""><i class="fa fa-flickr"></i></a>
                        <a class="youtube" target="_blank" href=""><i class="fa fa-youtube"></i></a>
                        <a class="google-plus" target="_blank" href=""><i class="fa fa-google-plus"></i></a>
                        <a class="linkedin" target="_blank" href=""><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@if(\Auth::user())
<a href="#" class="chat-with-admin" id="open-chat-with-admin">
    <i class="fa fa-weixin" style="margin-left: 15px"></i><span style="color: azure;font-weight: bold">&emsp;&emsp;&emsp;Chat with Admin</span>
</a>
@endif

<a href="#" class="back-to-top">
    <i class="fa fa-angle-up"></i>
</a>

<script src="//js.pusher.com/3.1/pusher.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/material.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/material-kit.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.parallax.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/wow.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jasny-bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/form-validator.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/contact-form-script.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/share.js') }}"></script>
