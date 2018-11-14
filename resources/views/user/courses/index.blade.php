@extends('user.layouts.default')

@section('title')
    {{ __('titles.course_list') }}
@endsection

@section('inline_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/courses_index.css') }}">
@endsection

@section('content')
<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 page-content">
                <div class="product-filter">
                    <div class="grid-list-count">
                        <a class="list switchToGrid" href="#"><i class="fa fa-list"></i></a>
                        <a class="grid switchToList active" id="switch-now" href="#"><i class="fa fa-th-large"></i></a>
                    </div>
                </div>
                <div class="adds-wrapper">
                    @foreach ($courses as $selectedCourse)
                        <div class="item-list">
                            <div class="col-sm-2 no-padding photobox">
                                <div class="add-image">
                                    <a href="#"><img src="{{ str_replace('public/', '', asset($selectedCourse->course_avatar)) }}" alt=""></a>
                                    <span class="photo-count"><i class="fa fa-eye"></i> {{ $selectedCourse->views }} </span>
                                </div>
                            </div>
                            <div class="col-sm-7 add-desc-box">
                                <div class="add-details">
                                    <h5 class="add-title"><a href="{{ route('courses.show', $selectedCourse->id) }}"> {{ $selectedCourse->title }} </a></h5>
                                    <div class="info">
                                        {{ __('titles.category') . ': ' . $selectedCourse->category->title }}
                                        <br>
                                        {{ __('titles.rate') }} &emsp;
                                        @for ($temp = 0; $temp < $selectedCourse->course_rate; $temp++)
                                            <span class="add-type"><i class="icon fa fa-star"></i></span>
                                        @endfor
                                        <br>
                                        <span class="category"> {{ __('titles.level') . $selectedCourse->level }}  </span> -
                                        <span class="item-location"><i class="fa fa-map-book"></i> {{ $selectedCourse->lecture_numbers . ' ' . __('titles.lectures') . ' ' . __('titles.in') . ' ' . $selectedCourse->duration . __('titles.hours') }} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 text-right price-box">
                                <h2 class="item-price"> {{ $selectedCourse->teacher_name }} </h2> 
                                <a class="btn btn-common btn-sm" href="{{ route('courses.show', $selectedCourse->id) }}"><i class="fa fa-info"></i><span> {{ __('titles.detail_course') }} </span></a>
                                <a class="btn btn-danger btn-sm"> <i class="fa fa-heart"></i> <span> {{ $selectedCourse->like }} </span> </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination-bar">
                    <ul class="pagination">
                        <li> {{ $courses->links() }} </li>
                    </ul>
                </div>
                @if (Auth::user()->role == 1)
                <div class="post-promo text-center">
                    <h2> {{ __('titles.create_course_p1') }} </h2>
                    <h5> {{ __('titles.create_course_p2') }} </h5>
                    <a href="post-ads.html" class="btn btn-post btn-danger"> {{ __('titles.create_course_p3') }} </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#switch-now').click();
        });
    </script>
@endsection
