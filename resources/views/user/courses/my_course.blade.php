@extends('user.layouts.default')

@section('title')
@endsection

@section('inline_styles')
@endsection

@section('content')
    {{ Breadcrumbs::render('my_course', \Auth::user()->id) }}<br>
    <div id="content">
        <div class="container">
            <div class="row">
                @include('user.partials.user_management_info')
                <div class="col-sm-9 page-content" id="cart">
                    <div class="inner-box">
                        <h2 class="title-2"><i class="fa fa-book"></i>&ensp;&ensp; {{ __('titles.my_course') }}
                            <span
                                    class="badge"></span></h2>
                        @if($courseList->isEmpty())
                            <image src="/assets/img/empty_cart.png" alt="Empty cart"
                                   style="display: block;margin-left: auto;margin-right: auto;width: 50%;"></image><br>
                            <h4 class="text-center"> {{ __('messages.you_haven_not_added_any_courses') }} </h4><br>
                            <a class="btn btn-common btn-search btn-block" href="{{ route('home') }}"
                               style="width: max-content;margin: 0 auto"
                               ;><strong>{{ __('titles.keep_shopping') }}</strong></a>
                        @else
                            <div class="table-responsive">
                                <div class="table-action">
                                    <div class="checkbox">
                                        <label for="checkAll">
                                            <input id="checkAll" type="checkbox">
                                            Select: All | <a href="#" class="btn btn-xs btn-danger"><i
                                                        class=" fa fa-trash"></i>Delete</a>
                                        </label>
                                    </div>
                                    <div class="table-search pull-right col-xs-7">
                                        <div class="form-group">
                                            <label class="col-xs-5 control-label text-right">Search <br>
                                                <a title="clear filter" class="clear-filter" href="#clear">[clear]</a>
                                            </label>
                                            <div class="col-xs-7 searchpan">
                                                <input class="form-control" id="filter" type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered add-manage-table"
                                       id="in-cart-item-table">
                                    <thead>
                                    <tr>
                                        <th data-type="numeric"></th>
                                        <th>{{ __('titles.image') }}</th>
                                        <th>{{ __('titles.course_detail') }}</th>
                                        <th>{{ __('titles.process') }}</th>
                                        <th>{{ __('titles.option') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($courseList as $course)
                                        <tr id="cart-item-{{$course->id}}">
                                            <td class="add-img-selector" id="checkbox-{{$course->id}}">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox">
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="add-img-td">
                                                <a href="{{ route('courses.show', $course->id) }}">
                                                    <img class="img-responsive"
                                                         src="{{ str_replace('public/', '', asset($course->course_avatar)) }}"
                                                         alt="img">
                                                </a>
                                            </td>
                                            <td class="ads-details-td">
                                                <h4>
                                                    <a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a>
                                                </h4>
                                                <p><strong> {{ __('titles.instructor') }} </strong>:
                                                    <a href="{{ route('users.show', $course->user->id) }}">{{ $course->user->name }}</a>
                                                </p>
                                                <p>
                                                    <strong> {{ __('titles.seller') }} </strong>: {{ $course->seller }}
                                                    <strong>{{ __('titles.schedule') }}
                                                        : </strong> {{ $course->lecture_numbers . ' ' . __('titles.lectures') . ' ' . __('titles.in') . ' ' . $course->duration . ' ' . __('titles.minutes') }}
                                                </p>
                                            </td>
                                            <td class="price-td">
                                                <strong>
                                                    {{ $course->learnedCount . '/' . $course->totalLecture }}<br>
                                                    {{ $course->process }}%
                                                </strong>
                                            </td>
                                            <td class="action-td">
                                                <p><a class="btn btn-danger btn-xs remove" href="{{ route('courses.show', $course->id) }}"> <i
                                                                class="fa fa-see"></i> {{ __('titles.go_to_course') }}
                                                    </a></p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{--                                <div class="col-sm-3">--}}
                                {{--                                    <h3> {{ __('titles.total') }}:</h3>--}}
                                {{--                                    @if($totalOriginPriceInCart !== $totalPromotionPriceInCart)--}}
                                {{--                                        <h2 style="color:red"> {{ $totalPromotionPriceInCart }}$ </h2>--}}
                                {{--                                        <h3><strike> {{ $totalOriginPriceInCart }}$ </strike></h3>--}}
                                {{--                                        <h4> @if($totalOriginPriceInCart !== 0) {{ number_format((float)(1 - $totalPromotionPriceInCart/$totalOriginPriceInCart)*100, 2, '.', '') }} @else--}}
                                {{--                                                0 @endif % {{ __('titles.off') }}</h4>--}}
                                {{--                                    @else--}}
                                {{--                                        <h3>{{ $totalOriginPriceInCart }}$</h3>--}}
                                {{--                                    @endif--}}
                                {{--                                </div>--}}
                                {{--                                <div class="col-sm-5">--}}
                                {{--                                    <div class="col-xs-9 searchpan">--}}
                                {{--                                        <input class="form-control" id="filter" type="text"--}}
                                {{--                                               placeholder="{{ __('titles.apply_coupon_code') }}">--}}
                                {{--                                    </div>--}}
                                {{--                                    <button type="submit" class="btn btn-xs pull-right"--}}
                                {{--                                            style="background-color:#3498db">Apply--}}
                                {{--                                    </button>--}}
                                {{--                                    <br><br>--}}
                                {{--                                    <p><i class="fa fa-check-circle"></i> 1811CYBERMONDAYEXTENSION is applied </p>--}}
                                {{--                                </div>--}}
                                {{--                                <div class="col-sm-4">--}}
                                {{--                                    <a href="{{ route('cart_items.checkout.get') }}">--}}
                                {{--                                        <button class="col-sm-9 btn"--}}
                                {{--                                                style="float:right; background-color:#3498db"> {{ __('titles.checkout') }} </button>--}}
                                {{--                                    </a>--}}
                                {{--                                </div>--}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('inline_scripts')
@endsection
