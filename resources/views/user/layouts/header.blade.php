<div class="header">
    <nav class="navbar navbar-default main-navigation" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="/"><img src="/assets/img/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="lnr lnr-enter"></i> {{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=""><i class="lnr lnr-user"></i> {{ __('Register') }}</a>
                    </li>
                    <li class="postadd">
                        <a class="btn btn-danger btn-post" href="post-ads.html"><span class="fa fa-plus-circle"></span> Post an Ad</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
        <div class="close" data-toggle="offcanvas" data-target=".navmenu">
            <i class="fa fa-close"></i>
        </div>
        <h3 class="title-menu"> {{ __('all_pages') }} </h3>
        <ul class="nav navmenu-nav"> 
            <li><a href=""> {{ __('home') }} </a></li>
            <li><a href=""> {{ __('register') }} </a></li>
            <li><a href=""> {{ __('login') }} </a></li>
        </ul>
    </div>
</div>
<div class="tbtn wow pulse" id="menu" data-wow-iteration="infinite" data-wow-duration="500ms" data-toggle="offcanvas" data-target=".navmenu">
    <p><i class="fa fa-file-text-o"></i> {{ __('all_pages') }} </p>
</div>
</div>
</div>
</div>
