@extends('user.layouts.default')

@section('title')
@endsection

@section('inline_styles')
@endsection

@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="product-info">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <h2 class="title-2"><strong> {{ __('titles.instructor_information') }} </strong></h2>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="ads-action">
                                    <ul class="list-border">
                                        <li>
                                            <img id="teacher-avatar"
                                                 src="{{ str_replace("public/", "", asset($selectedInstructor->avatar)) }}"
                                                 alt="">
                                        </li>
                                        <li style="margin-left: 20px"><h3>{{ $selectedInstructor->name }}</h3></li>
                                        <li style="margin-left: 20px">
                                            <a href="#"> <i class="fa fa-share-alt"></i> Social Contact </a>
                                            <div class="social-link">
                                                <a class="twitter" target="_blank" data-original-title="twitter"
                                                   href="#" data-toggle="tooltip" data-placement="top"><i
                                                            class="fa fa-twitter"></i></a>
                                                <a class="facebook" target="_blank" data-original-title="facebook"
                                                   href="#" data-toggle="tooltip" data-placement="top"><i
                                                            class="fa fa-facebook"></i></a>
                                                <a class="google" target="_blank" data-original-title="google-plus"
                                                   href="#" data-toggle="tooltip" data-placement="top"><i
                                                            class="fa fa-google"></i></a>
                                                <a class="linkedin" target="_blank" data-original-title="linkedin"
                                                   href="#" data-toggle="tooltip" data-placement="top"><i
                                                            class="fa fa-linkedin"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <br>
                                <aside class="panel panel-body panel-details">
                                    <ul style="margin-left: 5px">
                                        <li>
                                            <p class="no-margin"><strong>Total
                                                    students:</strong> {{ $instructorStudentsCount }} </p>
                                        </li>
                                        <li>
                                            <p class="no-margin"><strong>Courses:</strong> {{ $instructorCoursesCount }}
                                            </p>
                                        </li>
                                        <li>
                                            <p class="no-margin"><strong>Instructor
                                                    Rating:</strong> {{ $instructorRating }}☆ </p>
                                        </li>
                                    </ul>
                                </aside>
                            </div>
                            <div class="ads-details-info col-md-8">
                                <p class="mb15">{!! $selectedInstructor->personal_info !!}</p>
                                <ul class="list-circle">
                                    <li><i class="fa fa-envelope"></i><strong>&ensp;
                                            Email: </strong> {{ $selectedInstructor->email }}</li>
                                    <li><i class="fa fa-phone"></i><strong>&ensp;
                                            Phone: </strong> {{ $selectedInstructor->phone }}</li>
                                    <li><i class="fa fa-birthday-cake"></i><strong>&ensp;
                                            Birthday: </strong> {{ $selectedInstructor->birthday }}</li>
                                    <li><i class="fa fa-map-marker"></i><strong>&ensp;
                                            Address: </strong> {{ $selectedInstructor->address }}</li>
                                    <li><i class="fa fa-building"></i><strong>&ensp; Working
                                            Place: </strong> {{ $selectedInstructor->working_place }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
        </div>
        <section class="featured-lis mb30">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                        <h3 class="section-title"> {{ __('titles.courses_taught_by') . ' ' . $selectedInstructor->name }}</h3>
                        <div id="new-products" class="owl-carousel">
                            @foreach($bestCoursesInstructor as $course)
                                <div class="item">
                                    <div class="product-item">
                                        <div class="carousel-thumb">
                                            <img src="{{ str_replace('public/', '', asset($course->course_avatar)) }}"
                                                 style="height:142px"
                                                 alt="">
                                            <div class="overlay">
                                                <a href="{{ route('courses.show', $course->id) }}"><i
                                                            class="fa fa-info-circle"></i></a>
                                            </div>
                                        </div>
                                        <a href="ads-details.html" class="item-name"> {{ $course->title }} </a>
                                        <span class="price">@if(isset($course->promotion_price))<b
                                                    style="color:red">{{ $course->promotion_price }}$ </b><strike> {{ $course->origin_price }}$</strike>@else {{ $course->origin_price }}
                                            $@endif</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($instructorCoursesCount > 5)
                            <a class="btn btn-search btn-block"
                               href="{{ route('courses.index', ['user_id' => $selectedInstructor->id]) }}"
                               style="width: max-content;margin: 0 auto" ;><strong
                                        style="color: #3498db">{{ __('titles.see_more') }}</strong></a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('inline_scripts')
@endsection