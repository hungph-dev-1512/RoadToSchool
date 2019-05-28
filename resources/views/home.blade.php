@extends('user.layouts.default')

@section('title')
    {{ __('titles.road_to_school_home_page') }}
@endsection

@section('content')
    {{--    {{ dd(config('app.locale')) }}--}}
    <section id="intro" class="section-intro">
        <div class="overlay">
            <div class="container">
                <div class="main-text">
                    <h1 class="intro-title"> {{ __('titles.slogan_p1') }} <span
                                style="color: #3498db"> {{ __('titles.slogan_p2') }} </span></h1>
                    <p class="sub-title"> {{ __('titles.slogan_p3') }} </p>

                    <div class="row search-bar">
                        <div class="advanced-search">
                            <form class="search-form" method="get" action="{{ route('courses.index') }}">
                                <div class="col-md-3 col-sm-6 search-col">
                                    <input class="form-control keyword" name="keyword" value=""
                                           placeholder="{{ __('titles.keyword') }}" type="text">
                                    <i class="fa fa-search"></i>
                                </div>
                                <div class="col-md-3 col-sm-6 search-col">
                                    <div class="input-group-addon search-category-container">
                                        <label class="styled-select">
                                            <select class="dropdown-product selectpicker" name="filter_option">
                                                <option value="0"> {{ __('titles.select_filter_option') }} </option>
                                                @foreach (App\Models\Course::$filter_options as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 search-col">
                                    <div class="input-group-addon search-category-container">
                                        <label class="styled-select rate-select">
                                            <select class="dropdown-product selectpicker" name="course_rate">
                                                <option value="0"> {{ __('titles.select_rate') }} </option>
                                                @for ($temp=1; $temp<=4; $temp++)
                                                    <option value="{{ $temp }}">
                                                        @for ($tempStar=0; $tempStar<$temp; $tempStar++)
                                                            &#x2606;@endfor {{ __('titles.and_up') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 search-col">
                                    <input class="btn btn-common btn-search btn-block" type="submit"
                                           value="{{ __('titles.submit') }}">
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
                        <h3 class="section-title"> {{ __('titles.browse_course_from') . ' ' . App\Models\Category::where('parent_id', '<>', 0)->count() . ' ' . __('titles.l_categories') }}</h3>
                    </div>
                    @foreach(\App\Models\Category::where('parent_id', 0)->get() as $category)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="category-box border-1 wow fadeInUpQuick" data-wow-delay="0.3s">
                                <div class="icon">
                                    <i class="{{$category->css_classes}}"></i>
                                </div>
                                <div class="category-header">
                                    <h4> {{ $category->title }} </h4>
                                </div>
                                <div class="category-content">
                                    <ul>
                                        @foreach(\App\Models\Category::where('parent_id', $category->id)->limit(6)->get() as $subCategory)
                                            <li>
                                                <a href="{{ route('courses.index', ['sub_category_id' => $subCategory->id]) }}">{{ config('app.locale') == 'en' ? $subCategory->title : $subCategory->vi_title }}</a>
                                                <span class="category-counter"> {{ \App\Models\Course::where('is_accepted', 1)->where('category_id', $subCategory->id)->count() }} </span>
                                            </li>
                                        @endforeach
                                        <li>
                                            <a href="{{ route('courses.index', ['category_id' => $category->id]) }}">View
                                                all subcategories →</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="featured-lis">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                        <h3 class="section-title">{{ __('titles.recommended_courses') }}</h3>
                        <div id="new-products" class="owl-carousel">
                            @foreach($recommmendCourseList as $trendCourse)
                                <div class="item">
                                    <div class="product-item">
                                        <div class="carousel-thumb">
                                            <img src="{{ str_replace('public/', '', asset($trendCourse->course_avatar)) }}"
                                                 style="height:142px"
                                                 alt="">
                                            <div class="overlay">
                                                <a href="{{ route('courses.show', $trendCourse->id) }}"><i
                                                            class="fa fa-info-circle"></i></a>
                                            </div>
                                        </div>
                                        <a href="{{ route('courses.show', $trendCourse->id) }}"
                                           class="item-name"> {{ $trendCourse->title }} </a>
                                        <span class="price">@if($trendCourse->promotion_price === $trendCourse->origin_price)
                                                <b
                                                        style="color:red">{{ $trendCourse->promotion_price }}$ </b>
                                                <strike> {{ $trendCourse->origin_price }}$</strike>@else {{ $trendCourse->origin_price }}
                                                $@endif</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-lis">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                        <h3 class="section-title">{{ __('titles.most_seller_courses') }}</h3>
                        <div id="best-products" class="owl-carousel">
                            @foreach(\App\Models\Course::orderBy('seller', 'desc')->where('is_accepted', 1)->limit(20)->get() as $trendCourse)
                                <div class="item">
                                    <div class="product-item">
                                        <div class="carousel-thumb">
                                            <img src="{{ str_replace('public/', '', asset($trendCourse->course_avatar)) }}"
                                                 style="height:142px"
                                                 alt="">
                                            <div class="overlay">
                                                <a href="{{ route('courses.show', $trendCourse->id) }}"><i
                                                            class="fa fa-info-circle"></i></a>
                                            </div>
                                        </div>
                                        <a href="{{ route('courses.show', $trendCourse->id) }}"
                                           class="item-name"> {{ $trendCourse->title }} </a>
                                        <span class="price">@if($trendCourse->promotion_price === $trendCourse->origin_price)
                                                <b
                                                        style="color:red">{{ $trendCourse->promotion_price }}$ </b>
                                                <strike> {{ $trendCourse->origin_price }}$</strike>@else {{ $trendCourse->origin_price }}
                                                $@endif</span>
                                    </div>
                                </div>
                            @endforeach
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
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                                    repellat rerum assumenda facere.
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
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                                    repellat rerum assumenda facere.
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
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                                    repellat rerum assumenda facere.
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
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                                    repellat rerum assumenda facere.
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
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                                    repellat rerum assumenda facere.
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
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                                    repellat rerum assumenda facere.
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
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                                    repellat rerum assumenda facere.
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
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                                    repellat rerum assumenda facere.
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
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni perferendis
                                    repellat rerum assumenda facere.
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
                            <p>Join our 10,000+ subscribers and get access to the latest templates, freebies,
                                announcements and resources!</p>
                            <div class="subscribe">
                                <input class="form-control" name="EMAIL" placeholder="Your email here" required=""
                                       type="email">
                                <button class="btn btn-common" type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight" data-wow-delay="1s">
                        <h3 class="title-2"><i class="fa fa-search"></i> Popular Searches</h3>
                        <ul class="cat-list col-sm-4">
                            <li><a href="account-saved-search.html">puppies</a></li>
                            <li><a href="account-saved-search.html">puppies for sale</a></li>
                            <li><a href="account-saved-search.html">bed</a></li>
                            <li><a href="account-saved-search.html">household</a></li>
                            <li><a href="account-saved-search.html">chair</a></li>
                            <li><a href="account-saved-search.html">materials</a></li>
                        </ul>
                        <ul class="cat-list col-sm-4">
                            <li><a href="account-saved-search.html">sofa</a></li>
                            <li><a href="account-saved-search.html">wanted</a></li>
                            <li><a href="account-saved-search.html">furniture</a></li>
                            <li><a href="account-saved-search.html">van</a></li>
                            <li><a href="account-saved-search.html">wardrobe</a></li>
                            <li><a href="account-saved-search.html">caravan</a></li>
                        </ul>
                        <ul class="cat-list col-sm-4">
                            <li><a href="account-saved-search.html">for sale</a></li>
                            <li><a href="account-saved-search.html">free</a></li>
                            <li><a href="account-saved-search.html">1 bedroom flat</a></li>
                            <li><a href="account-saved-search.html">photo+video</a></li>
                            <li><a href="account-saved-search.html">bmw</a></li>
                            <li><a href="account-saved-search.html">Land </a></li>
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
                            <i class="lnr lnr-graduation-hat"></i>
                        </span>
                        </div>
                        <div class="desc">
                            <h3 class="counter">23453</h3>
                            <p>Students</p>
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
                            <h3 class="counter">4053</h3>
                            <p>Courses</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="counting wow fadeInDownQuick" data-wow-delay="1.5s">
                        <div class="icon">
                        <span>
                            <i class="lnr lnr-user"></i>
                        </span>
                        </div>
                        <div class="desc">
                            <h3 class="counter">350</h3>
                            <p>Instructors</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="counting wow fadeInDownQuick" data-wow-delay="2s">
                        <div class="icon">
                        <span>
                            <i class="lnr lnr-film-play"></i>
                        </span>
                        </div>
                        <div class="desc">
                            <h3 class="counter">12090</h3>
                            <p>Minutes of video</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
