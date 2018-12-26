@extends('user.layouts.default')

@section('inline_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/lectures_show.css') }}">
@endsection

@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    {!! $embed->code !!}
                    <div class="author">
                        <div class="inner-box">
                            <div class="author-img">
                                <img id="teacher-avatar" src="{{ str_replace("public/", "", asset($teacher->avatar)) }}"
                                     alt="">
                            </div>
                            <div class="author-text">
                                <div class="author-title">
                                    <h3 class="pull-left"> {{ $teacher->name }} </h3>
                                    <div class="social-link pull-right">
                                        <a class="twitter" target="_blank" data-original-title="twitter" href="#"
                                           data-toggle="tooltip" data-placement="top"><i class="fa fa-twitter"></i></a>
                                        <a class="facebook" target="_blank" data-original-title="facebook" href="#"
                                           data-toggle="tooltip" data-placement="top"><i class="fa fa-facebook"></i></a>
                                        <a class="google" target="_blank" data-original-title="google-plus" href="#"
                                           data-toggle="tooltip" data-placement="top"><i class="fa fa-google"></i></a>
                                        <a class="linkedin" target="_blank" data-original-title="linkedin" href="#"
                                           data-toggle="tooltip" data-placement="top"><i class="fa fa-linkedin"></i></a>
                                    </div>
                                </div>
                                <br>
                                <p> {{ $description }} </p>
                            </div>
                        </div>
                    </div>
                </div>

                <aside id="sidebar" class="col-md-4 right-sidebar">

                    <div class="widget">
                        <div class="categories">
                            <div class="widget-title">
                                <button class="btn btn-sm"
                                        onclick="openTab('all-lecture')"> {{ __('all_lecture') }} </button>
                                <button class="btn btn-sm"
                                        onclick="openTab('discussion')"> {{ __('discussion') }} </button>
                            </div>
                            <div class="categories-list tab" id="all-lecture">
                                <ul>
                                    @foreach($lectures as $lecture)
                                        <li>
                                            <a class="@if($lecture->id == $lectureId) selected @endif"
                                               href="{{ url('/courses/' . $id . '/lectures/' . $lecture->id) }}">
                                                <i class="fa fa-cutlery"></i> {{ $lecture->title }}
                                                <span class="category-counter"> {{ $lecture->duration }} </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="categories-list tab" id="discussion">
                            </div>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>
@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('iframe').attr('width', 750);
            $('iframe').attr('height', 370);
            $('iframe').attr('src', $('iframe').attr('src').replace('feature=oembed', 'autoplay=1'));
        });

        function openTab(tab) {
            $('.tab').attr('style', 'display:none');
            $('#' + tab).attr('style', 'display:block');
        }
    </script>
@endsection
