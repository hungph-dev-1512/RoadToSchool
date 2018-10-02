@extends('user.layouts.default')

@section('title')
    {{ __('titles.home') }}
@endsection

@section('content')

<section id="intro" class="section-intro">
    <div class="overlay">
        <div class="container">
            <div class="main-text">
                <h1 class="intro-title"> {{ __('titles.slogan_p1') }} <span style="color: #e75400"> {{ __('titles.slogan_p2') }} </span></h1>
                <p class="sub-title"> {{ __('titles.slogan_p3') }} </p>

                <div class="row search-bar">
                        <div class="advanced-search">
                            <form class="search-form" method="get">
                                <div class="col-md-3 col-sm-6 search-col">
                                    <div class="input-group-addon search-category-container">
                                        <label class="styled-select">
                                            <select class="dropdown-product selectpicker" name="product-cat">
                                                <option value="0"> {{ __('titles.select_category') }} </option>
                                                {{-- @foreach(\App\Models\Category::all() as $category)
                                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                                @endforeach --}}
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 search-col">
                                    <div class="input-group-addon search-category-container">
                                        <label class="styled-select location-select">
                                            <select class="dropdown-product selectpicker" name="product-cat">
                                                <option value="0"> {{ __('titles.select_level') }} </option>
                                                @for ($temp=1; $temp<=3; $temp++)
                                                    <option value="{{ $temp }}">
                                                        {{ __('titles.level') . $temp }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 search-col">
                                    <input class="form-control keyword" name="keyword" value="" placeholder="{{ __('titles.keyword') }}" type="text">
                                    <i class="fa fa-search"></i>
                                </div>
                                <div class="col-md-3 col-sm-6 search-col">
                                    <button class="btn btn-common btn-search btn-block"><strong>Search</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>

<div class="wrapper">

    <section id="categories-homepage">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title">Browse Ads from 8 Categories</h3>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box border-1 wow fadeInUpQuick" data-wow-delay="0.3s">
                        <div class="icon">
                            <a href="category.html"><i class="lnr lnr-users color-1"></i></a>
                        </div>
                        <div class="category-header">
                            <a href="category.html"><h4>Community</h4></a>
                        </div>
                        <div class="category-content">
                            <ul>
                                <li>
                                    <a href="category.html">Announcements</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Car Pool - Bike Ride</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Charity - Donate - NGO</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Lost - Found</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Tender Notices</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">General Entertainment</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">View all subcategories →</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box border-2 wow fadeInUpQuick" data-wow-delay="0.6s">
                        <div class="icon">
                            <a href="category.html"><i class="lnr lnr-laptop-phone color-2"></i></a>
                        </div>
                        <div class="category-header">
                            <a href="category.html"><h4>Electronics</h4></a>
                        </div>
                        <div class="category-content">
                            <ul>
                                <li>
                                    <a href="category.html">Home Electronics</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">LCDs</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Charity - Donate - NGO</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Mobile & Tablets</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">TV & DVDs</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Technical Services</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Others</a>
                                    <sapn class="category-counter">1</sapn>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box border-3 wow fadeInUpQuick" data-wow-delay="0.9s">
                        <div class="icon">
                            <a href="category.html"><i class="lnr lnr-cog color-3"></i></a>
                        </div>
                        <div class="category-header">
                            <a href="category.html"><h4>Services</h4></a>
                        </div>
                        <div class="category-content">
                            <ul>
                                <li>
                                    <a href="category.html">Cleaning Services</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Educational</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Food Services</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Medical</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Office & Home Removals</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">General Entertainment</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">View all subcategories →</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box border-4 wow fadeInUpQuick" data-wow-delay="1.2s">
                        <div class="icon">
                            <a href="category.html"><i class="lnr lnr-cart color-4"></i></a>
                        </div>
                        <div class="category-header">
                            <a href="category.html"><h4>Shopping</h4></a>
                        </div>
                        <div class="category-content">
                            <ul>
                                <li>
                                    <a href="category.html">Bags</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Beauty Products</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Jewelry</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Shoes M/F</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Tender Notices</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Others</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box border-5 wow fadeInUpQuick" data-wow-delay="1.5s">
                        <div class="icon">
                            <a href="category.html"><i class="lnr lnr-briefcase color-5"></i></a>
                        </div>
                        <div class="category-header">
                            <a href="category.html"><h4>Jobs</h4></a>
                        </div>
                        <div class="category-content">
                            <ul>
                                <li>
                                    <a href="category.html">Accounts Jobs</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Cleaning & Washing</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Web design</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Design & Code</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Finance Jobs</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Data Entry</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">View all subcategories →</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box border-6 wow fadeInUpQuick" data-wow-delay="1.8s">
                        <div class="icon">
                            <a href="category.html"><i class="lnr lnr-graduation-hat color-6"></i></a>
                        </div>
                        <div class="category-header">
                            <a href="category.html"><h4>Training</h4></a>
                        </div>
                        <div class="category-content">
                            <ul>
                                <li>
                                    <a href="category.html">Android Development</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">20 Days HTML/CSS</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">iOS Development with Swift</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">SEO for rest of us</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Mastering in Java</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Others</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">View all subcategories →</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box border-7 wow fadeInUpQuick" data-wow-delay="2.1s">
                        <div class="icon">
                            <a href="category.html"><i class="lnr lnr-apartment color-7"></i></a>
                        </div>
                        <div class="category-header">
                            <a href="category.html"><h4>Real Estate</h4></a>
                        </div>
                        <div class="category-content">
                            <ul>
                                <li>
                                    <a href="category.html">Farms</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Home for rent</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Hotels</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Land for sale</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Offices for rent</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Others</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="category-box border-8 wow fadeInUpQuick" data-wow-delay="2.3s">
                        <div class="icon">
                            <a href="category.html"><i class="lnr lnr-car color-8"></i></a>
                        </div>
                        <div class="category-header">
                            <a href="category.html"><h4>Vehicles</h4></a>
                        </div>
                        <div class="category-content">
                            <ul>
                                <li>
                                    <a href="category.html">Cars</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Fancy Cars</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Kids Bikes</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Motor Bikes</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Classic & Modern</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">Kinds</a>
                                    <sapn class="category-counter">3</sapn>
                                </li>
                                <li>
                                    <a href="category.html">View all subcategories →</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="featured-lis">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                    <h3 class="section-title">Featured Listings</h3>
                    <div id="new-products" class="owl-carousel">
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="assets/img/product/img1.jpg" alt="">
                                    <div class="overlay">
                                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>
                                <span class="price">$150</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="assets/img/product/img2.jpg" alt="">
                                    <div class="overlay">
                                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="ads-details.html" class="item-name">Sed diam nonummy</a>
                                <span class="price">$67</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="assets/img/product/img3.jpg" alt="">
                                    <div class="overlay">
                                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="ads-details.html" class="item-name">Feugiat nulla facilisis</a>
                                <span class="price">$300</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="assets/img/product/img4.jpg" alt="">
                                    <div class="overlay">
                                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>
                                <span class="price">$149</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="assets/img/product/img5.jpg" alt="">
                                    <div class="overlay">
                                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="ads-details.html" class="item-name">Sed diam nonummy</a>
                                <span class="price">$90</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="assets/img/product/img6.jpg" alt="">
                                    <div class="overlay">
                                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="ads-details.html" class="item-name">Praesent luptatum zzril</a>
                                <span class="price">$169</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="assets/img/product/img7.jpg" alt="">
                                    <div class="overlay">
                                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="ads-details.html" class="item-name">Lorem ipsum dolor sit</a>
                                <span class="price">$79</span>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="assets/img/product/img8.jpg" alt="">
                                    <div class="overlay">
                                        <a href="ads-details.html"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="ads-details.html" class="item-name">Sed diam nonummy</a>
                                <span class="price">$149</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="features">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="0.3s">
                        <div class="features-icon">
                            <i class="fa fa-book">
                            </i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Full Documented
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="0.6s">
                        <div class="features-icon">
                            <i class="fa fa-paper-plane"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Clean & Modern Design
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="0.9s">
                        <div class="features-icon">
                            <i class="fa fa-map"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Great Features
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="1.2s">
                        <div class="features-icon">
                            <i class="fa fa-cogs"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Completely Customizable
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="1.5s">
                        <div class="features-icon">
                            <i class="fa fa-hourglass"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                100% Responsive Layout
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="1.8s">
                        <div class="features-icon">
                            <i class="fa fa-hashtag"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                User Friendly
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="2.1s">
                        <div class="features-icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Awesome Layout
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="2.4s">
                        <div class="features-icon">
                            <i class="fa fa-leaf"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                High Quality
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="features-box wow fadeInDownQuick" data-wow-delay="2.7s">
                        <div class="features-icon">
                            <i class="fa fa-google"></i>
                        </div>
                        <div class="features-content">
                            <h4>
                                Free Google Fonts Use
                            </h4>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis repellat rerum assumenda facere.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="location">
        <div class="container">
            <div class="row localtion-list">
                <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-delay="0.5s">
                    <h3 class="title-2"><i class="fa fa-envelope"></i> Subscribe for updates</h3>
                    <form id="subscribe" action="#">
                        <p>Join our 10,000+ subscribers and get access to the latest templates, freebies, announcements and resources!</p>
                        <div class="subscribe">
                            <input class="form-control" name="EMAIL" placeholder="Your email here" required="" type="email">
                            <button class="btn btn-common" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight" data-wow-delay="1s">
                    <h3 class="title-2"><i class="fa fa-search"></i> Popular Searches</h3>
                    <ul class="cat-list col-sm-4">
                        <li> <a href="account-saved-search.html">puppies</a></li>
                        <li> <a href="account-saved-search.html">puppies for sale</a></li>
                        <li> <a href="account-saved-search.html">bed</a></li>
                        <li> <a href="account-saved-search.html">household</a></li>
                        <li> <a href="account-saved-search.html">chair</a></li>
                        <li> <a href="account-saved-search.html">materials</a></li>
                    </ul>
                    <ul class="cat-list col-sm-4">
                        <li> <a href="account-saved-search.html">sofa</a></li>
                        <li> <a href="account-saved-search.html">wanted</a></li>
                        <li> <a href="account-saved-search.html">furniture</a></li>
                        <li> <a href="account-saved-search.html">van</a></li>
                        <li> <a href="account-saved-search.html">wardrobe</a></li>
                        <li> <a href="account-saved-search.html">caravan</a></li>
                    </ul>
                    <ul class="cat-list col-sm-4">
                        <li> <a href="account-saved-search.html">for sale</a></li>
                        <li> <a href="account-saved-search.html">free</a></li>
                        <li> <a href="account-saved-search.html">1 bedroom flat</a></li>
                        <li> <a href="account-saved-search.html">photo+video</a></li>
                        <li> <a href="account-saved-search.html">bmw</a></li>
                        <li> <a href="account-saved-search.html">Land </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

</div>

<section id="counter">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick" data-wow-delay=".5s">
                    <div class="icon">
                        <span>
                            <i class="lnr lnr-tag"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter">12090</h3>
                        <p>Regular Ads</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick" data-wow-delay="1s">
                    <div class="icon">
                        <span>
                            <i class="lnr lnr-map"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter">350</h3>
                        <p>Locations</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick" data-wow-delay="1.5s">
                    <div class="icon">
                        <span>
                            <i class="lnr lnr-users"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter">23453</h3>
                        <p>Reguler Members</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="counting wow fadeInDownQuick" data-wow-delay="2s">
                    <div class="icon">
                        <span>
                            <i class="lnr lnr-license"></i>
                        </span>
                    </div>
                    <div class="desc">
                        <h3 class="counter">150</h3>
                        <p>Premium Ads</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
