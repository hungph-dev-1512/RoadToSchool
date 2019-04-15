@extends('user.layouts.default')

@section('title')
    {{ $selectedCourse->title . ' - ' . __('titles.course') }}
@endsection

@section('content')
    {{ Breadcrumbs::render('courses_show', $selectedCourse) }}<br>
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="product-info">
                    <div class="col-sm-8">
                        <div class="inner-box ads-details-wrapper">
                            <h2> {{ $selectedCourse->name }} </h2>
                            <p class="item-intro"><span
                                        class="poster"> {{ __('titles.updated_at') . ' ' . $selectedCourse->updated_at . ' ' . __('titles.by') . ' ' . $selectedCourse->user->name }} </span>
                            </p>
                            <div id="owl-demo" class="owl-carousel owl-theme">
                                <div class="item">
                                    <img src="{{ str_replace('public/', '', asset($selectedCourse->course_avatar)) }}"
                                         alt="">
                                </div>
                                <div class="item">
                                    <img src="{{ str_replace('public/', '', asset($selectedCourse->course_avatar_2)) }}"
                                         alt="">
                                </div>
                                <div class="item">
                                    <img src="{{ str_replace('public/', '', asset($selectedCourse->course_avatar_3)) }}"
                                         alt="">
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <h2 class="title-2"><strong> {{ __('titles.course_description') }} </strong></h2>
                            <div class="row">
                                <div class="ads-details-info col-md-8" style="margin-left: 35px">
                                    <p class="mb15"> {!! $selectedCourse->description !!} </p>
                                </div>
                                <div class="col-md-4" id="active-btn">
                                    <div class="ads-action">
                                        <ul class="list-border">
                                            <li>
                                            <li>
                                                <div class="social-link">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="box">
                            <h2 class="title-2"><strong> {{ __('titles.all_lectures') }} </strong></h2>
                            <table class="table table-striped table-bordered add-manage-table" id="table">
                                <thead>
                                <tr>
                                    <th class="text-center col-xs-1"> Index</th>
                                    <th class="text-center col-xs-6"> Title</th>
                                    @if(isset($availableCourse))
                                        <th class="text-center col-xs-2"> Time</th>
                                        <th class="text-center col-xs-3">
                                            {{-- <a href="#" class="create-modal btn btn-success btn-sm" id="add-lecture">
                                                <i class="glyphicon glyphicon-plus"></i>
                                            </a> --}}
                                        </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($allLectures as $key => $lecture)
                                    <tr id="lecture-{{ $lecture->id }}">
                                        <td class="col-xs-2 text-center">
                                            <p> {{ __('titles.lecture') . ' ' . ($key + 1) }} </p>
                                        </td>
                                        <td class="col-xs-6">
                                            <p> {{ $lecture->title }} </p>
                                        </td>
                                        @if($availableCourse)
                                            <td class="col-xs-2 text-center">
                                                <p> {{ $lecture->duration }} </p>
                                            </td>
                                            <td class="col-xs-2 text-center">
                                                {{-- <a href="{{ url('/courses/' . $id . '/lectures/' . $lecture->id) }}" class="show-modal btn btn-info btn-sm" data-id="">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{ $lecture->id }}" data-title="{{ $lecture->uploaded_file_title }}" data-description="{{ $lecture->uploaded_file_description }}" data-link="{{ $lecture->uploaded_file_link }}">
                                                    <i class="glyphicon glyphicon-pencil"></i>
                                                </a>
                                                <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{ $lecture->id }}">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </a> --}}
                                                <a href="{{ url('/courses/' . $selectedCourse->id . '/lectures/' . $lecture->id) }}"
                                                   class="show-modal btn btn-info btn-sm" data-id="">
                                                    <i class="fa fa-eye"></i> {{ __('titles.start') }}
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div id="comments">
                            <div class="inner-box">
                                <h3>Comments ({{ $comments->count() }})</h3>
                                <ol class="comments-list" id="comment-list">
                                    @foreach($comments as $comment)
                                        <li id="li-comment-{{ $comment->id }}">
                                            <div class="media">
                                                <div class="thumb-left">
                                                    <a href="{{ route('users.show', $comment->user->id) }}">
                                                        <img alt="{{ $comment->user->name }}"
                                                             style="height: 75px; width: 75px"
                                                             src="{{ str_replace('public/', '', asset($comment->user->avatar)) }}"/>
                                                    </a>
                                                </div>
                                                <div class="info-body">
                                                    <div class="media-heading">
                                                        <h4 class="name">{{ $comment->user->name }}</h4> |
                                                        <span class="comment-date">{{ $comment->updated_at }}</span>
                                                        <a class="reply-link" data-id="{{ $comment->id }}"
                                                           data-tagged="{{ $comment->user->id }}"><i
                                                                    class="fa fa-reply-all"></i> Reply</a>
                                                    </div>
                                                    {!!  $comment->content !!}
                                                </div>
                                            </div>
                                            <br>
                                            <div class="reply-comment" style="display: none" id="reply-comment-{{ $comment->id }}">
                                                <form>
                                                    <div class="row">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                        <div class="row">
                                                            <div class=" col-md-10 pull-right">
                                                                <div class="form-group">
                        <textarea id="content-{{ $comment->id }}" class="form-control" name="content" cols="30"
                                  rows="1" placeholder="Write a reply...">@if($comment->user->name !== \Auth::user()->name) {{ $comment->user->name }} @endif</textarea>
                                                                </div>
                                                                <input type="hidden" name="taggedUser" id="tagged-user-{{ $comment->id }}">
                                                                <button type="submit" id="submit" class="btn btn-sm btn-common submit-reply-comment" data-parent="{{ $comment->id }}">
                                                                    Reply
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <ul id="reply-comment-{{ $comment->id }}-list">
                                                @foreach($comment->child_comments as $child_comment)
                                                    <li>
                                                        <div class="media">
                                                            <div class="thumb-left">
                                                                <a  href="{{ route('users.show', $comment->user->id) }}">
                                                                    <img alt="{{ $child_comment->user->name }}" style="height: 75px; width: 75px" src="{{ str_replace('public/', '', asset($child_comment->user->avatar)) }}"/>
                                                                </a>
                                                            </div>
                                                            <div class="info-body">
                                                                <div class="media-heading">
                                                                    <h4 class="name">{{ $child_comment->user->name }}</h4> |
                                                                    <span class="comment-date">{{ $child_comment->updated_at }}</span>
                                                                    <a class="reply-link" data-id="{{ $comment->id }}" data-tagged="{{ $child_comment->user->id }}" data-child="{{ $child_comment->id }}"><i class="fa fa-reply-all"></i> Reply </a>
                                                                </div>
                                                                <p>{!! $child_comment->content !!} </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <br>
                                                    <div class="reply-comment" style="display: none" id="reply-comment-{{ $comment->id }}-from-{{ $child_comment->id }}">
                                                        <form>
                                                            <div class="row">
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                                <div class="row">
                                                                    <div class=" col-md-12 pull-right">
                                                                        <div class="form-group">
                        <textarea id="content-{{ $child_comment->id }}" class="form-control" name="content" cols="30"
                                  rows="1" placeholder="Write a reply...">@if($child_comment->user->name !== \Auth::user()->name) {{ $child_comment->user->name }} @endif</textarea>
                                                                        </div>
                                                                        <input type="hidden" name="taggedUser" id="tagged-user-{{ $child_comment->user->id }}">
                                                                        <button type="submit" id="submit" class="btn btn-sm btn-common submit-reply-child-comment" data-child="{{ $child_comment->id }}" data-parent="{{ $comment->id }}">
                                                                            Reply
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ol>

                                <div id="respond">
                                    <h2 class="respond-title">Write a comment for
                                        course {{ $selectedCourse->title }}</h2>
                                    <form>
                                        <div class="row">
                                            <input type="hidden" id="comment-course-id" value="{{ $selectedCourse->id }}">
                                            <input type="hidden" id="comment-user-id" value="{{ Auth::user()->id }}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                    <textarea id="comment-content" class="form-control" name="content"
                                                              cols="45"
                                                              rows="2" placeholder="Comment..."></textarea>
                                                    </div>
                                                    <button type="submit" id="submit-comment" class="btn btn-common">
                                                        Post
                                                        Comment
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <div class="inner-box">
                            <div class="widget-title">
                                <h4>{{ __('titles.course_detail') }}</h4>
                            </div>
                            <p class=" no-margin ">
                                <strong> {{ __('titles.teacher') }} </strong><a
                                        href="{{ route('instructor_info', $selectedCourse->user->id) }}"> {{ $selectedCourse->user->name }} </a>
                            </p>
                            <p class="no-margin"><strong> {{ __('titles.category') }} </strong> <a
                                        href="#"> {{ $selectedCourse->category->title }} </a></p>
                            <p class="no-margin">
                                <strong> {{ __('titles.lectures_1') }} </strong> {{ $selectedCourse->lecture_numbers . ' ' . __('titles.lectures') }}
                            </p>
                            <p class="no-margin">
                                <strong> {{ __('titles.duration') }} </strong> {{ $selectedCourse->duration . ' ' . __('titles.minutes')}}
                            </p>
                            <p class="no-margin">
                                <strong> {{ __('titles.seller') }} </strong> {{ $selectedCourse->seller }} </p>
                            <p class="no-margin"><strong> {{ __('titles.like') }} </strong> {{ $selectedCourse->like }}
                            </p><br>
                            <a href="#"> <i class=" fa fa-heart"></i>&ensp; {{ __('titles.like') }} </a></li><br>
                            <i class="fa fa-share-alt" id="share"></i>&ensp; {{ __('titles.share') }}
                            <div class="social-link">
                                <a class="twitter" target="_blank" data-original-title="twitter" href="#"
                                   data-toggle="tooltip" data-placement="top"><i class="fa fa-twitter"
                                                                                 style="margin-top: 8px"></i></a>
                                <a class="facebook" target="_blank" data-original-title="facebook" href="#"
                                   data-toggle="tooltip" data-placement="top"><i class="fa fa-facebook"
                                                                                 style="margin-top: 8px"></i></a>
                                <a class="google" target="_blank" data-original-title="google-plus" href="#"
                                   data-toggle="tooltip" data-placement="top"><i class="fa fa-google"
                                                                                 style="margin-top: 8px"></i></a>
                                <a class="linkedin" target="_blank" data-original-title="linkedin" href="#"
                                   data-toggle="tooltip" data-placement="top"><i class="fa fa-linkedin"
                                                                                 style="margin-top: 8px"></i></a>
                            </div>
                            </li>
                            <br>
                            @if(!$availableCourse)
                                <a class="btn btn-common btn-sm" href="" id="add-to-cart"
                                   data-id="{{ $selectedCourse->id }}"><i
                                            class=" fa fa-cart-plus"></i><span> {{ __('titles.add_to_cart') }} </span></a>
                                <a class="btn btn-common btn-sm" href="" id="buy-now"
                                   data-id="{{ $selectedCourse->id }}"><i
                                            class=" fa fa-credit-card"></i><span> {{ __('titles.buy_now') }} </span></a>
                            @endif
                        </div>
                        <div class="inner-box">
                            <div class="widget-title">
                                <h4>{{ __('titles.teacher_info') }}</h4>
                            </div>
                            {{ __('titles.posted_by') }} &ensp; <i class=" fa fa-user"></i> <a
                                    href="{{ route('instructor_info', $selectedCourse->user->id) }}"> {{ $selectedCourse->user->name }} </a></li>
                            <br>
                            <p><i class=" fa fa-envelope"></i>&ensp; {{ $selectedCourse->user->email }}</p>
                            <p><i class=" fa fa-phone"></i>&ensp; {{ $selectedCourse->user->phone }}</p><br>
                            <p><a class="btn btn-common btn-sm"
                                  href="{{ route('instructor_info', $selectedCourse->user->id) }}"><i
                                            class=" fa fa-info"></i><span> {{ __('titles.see_details') }} </span></a>
                        </div>
                        <div class="col-xs-12">
                            <div class="features-box wow fadeInDownQuick" data-wow-delay="0.3s">
                                <div class="features-icon">
                                    <i class="lnr lnr-star">
                                    </i>
                                </div>
                                <div class="features-content">
                                    <h4>
                                        Fraud Protection
                                    </h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni
                                        perferendis repellat rerum assumenda facere.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="features-box wow fadeInDownQuick" data-wow-delay="0.6s">
                                <div class="features-icon">
                                    <i class="lnr lnr-chart-bars"></i>
                                </div>
                                <div class="features-content">
                                    <h4>
                                        No Extra Fees
                                    </h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni
                                        perferendis repellat rerum assumenda facere.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="features-box wow fadeInDownQuick" data-wow-delay="0.9s">
                                <div class="features-icon">
                                    <i class="lnr lnr-spell-check"></i>
                                </div>
                                <div class="features-content">
                                    <h4>
                                        Verified Data
                                    </h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni
                                        perferendis repellat rerum assumenda facere.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="features-box wow fadeInDownQuick" data-wow-delay="0.9s">
                                <div class="features-icon">
                                    <i class="lnr lnr-smile"></i>
                                </div>
                                <div class="features-content">
                                    <h4>
                                        Friendly Return Policy
                                    </h4>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo aut magni
                                        perferendis repellat rerum assumenda facere.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="featured-lis mb30">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                        <h3 class="section-title"> {{ __('titles.related_courses') }}</h3>
                        <div id="new-products" class="owl-carousel">
                            @foreach($mostRelatedCourse as $course)
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
                        @if($relatedCourseCount > 5)
                            <a class="btn btn-search btn-block"
                               href="{{ route('courses.index', ['sub_category_id' => $selectedCourse->category_id]) }}"
                               style="width: max-content;margin: 0 auto" ;><strong
                                        style="color: #3498db">{{ __('titles.see_more') }}</strong></a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection

@include('user.courses.partials.javascript_common')
@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.reply-link').css({'cursor': 'pointer'});

            replyJavascript();

            // Pusher area
            var comments = $('#comment-list');

            // Thay giá trị PUSHER_APP_KEY vào chỗ xxx này nhé
            var pusher = new Pusher('f2b354d9cdae3999c31d', {
                encrypted: true,
                cluster: "ap1"
            });

            // Subscribe to the channel we specified in our Laravel Event
            var channel = pusher.subscribe('comment');

            // Bind a function to a Event (the full Laravel class)
            channel.bind('App\\Events\\GetCommentFromPusherEvent', function (data) {
                var commentedUser = jQuery.parseJSON(data.user);
                var userAvatar = commentedUser.avatar;
                userAvatar = userAvatar.replace("images/", "http://127.0.0.1:8000/images/");
                var createdComment = jQuery.parseJSON(data.createdComment);
                var newCommentHtml =
                    '<li id="li-comment-' + createdComment.id + '"><div class="media"><div class="thumb-left"><img alt="'
                    + commentedUser.name +
                    '" style="height: 75px; width: 75px" src="'
                    + userAvatar +
                    '"/></a></div><div class="info-body"><div class="media-heading"><h4 class="name">'
                    + commentedUser.name +
                    '</h4><span class="comment-date">'
                    + createdComment.updated_at +
                    '</span> <a class="reply-link" data-id="'
                    + createdComment.id +
                    '" data-tagged="' + createdComment.user_id + '"><i class="fa fa-reply-all"></i> Reply</a> </div>'
                    + data.content +
                    '</div></div><br><div class="reply-comment" style="display: none" id="reply-comment-'
                    + createdComment.id +'"><form><div class="row">@csrf<div class="row"> <div class=" col-md-10 pull-right"> <div class="form-group"> <textarea id="content-' + createdComment.id +'" class="form-control" name="content" cols="30"rows="1" placeholder="Write a reply..."></textarea> </div> <input type="hidden" name="taggedUser" id="tagged-user-'
                    + createdComment.id +'"><button type="submit" id="submit" class="btn btn-sm btn-common submit-reply-comment" data-parent="'
                    + createdComment.id +
                    '">Reply </button> </div> </div> </div> </form></div><ul id="reply-comment-'+ createdComment.id +'-list"></ul></li>';
                comments.append(newCommentHtml).ready(function() {
                    $('.reply-link').css({'cursor': 'pointer'});
                });
            });

            // Subscribe to the channel we specified in our Laravel Event
            var replyChannel = pusher.subscribe('replyComment');

            // Bind a function to a Event (the full Laravel class)
            replyChannel.bind('App\\Events\\GetReplyCommentFromPusherEvent', function (data) {
                var replyComments = $('#reply-comment-' + data.parentCommentId + '-list');
                var commentedUser = jQuery.parseJSON(data.user);
                var userAvatar = commentedUser.avatar;
                userAvatar = userAvatar.replace("images/", "http://127.0.0.1:8000/images/");
                var createdComment = jQuery.parseJSON(data.createdComment);
                var replyUser = '';
                var currentUserId = '{{ \Auth::user()->id }}';
                if(commentedUser.id != currentUserId) {
                    replyUser = commentedUser.name;
                }
                var newCommentHtml = '<li> <div class="media"><div class="thumb-left"><img alt="'
                    + commentedUser.name +
                    '" style="height: 75px; width: 75px" src="'
                    + userAvatar +
                    '"/></a></div><div class="info-body"><div class="media-heading"><h4 class="name">'
                    + commentedUser.name +
                    '</h4><span class="comment-date">'
                    + createdComment.updated_at +
                    '</span><a class="reply-link" data-id="' + data.parentCommentId +'" data-child="' + createdComment.id +'" data-tagged="'
                    + createdComment.user_id +
                    '"><i class="fa fa-reply-all"></i> Reply</a></div>'
                    + data.content +
                    '</div></div><br><div class="reply-comment" style="display: none" id="reply-comment-' + data.parentCommentId +'-from-'
                    + createdComment.id
                    +'"><form><div class="row">@csrf<div class="row"><div class=" col-md-12 pull-right"><div class="form-group"><textarea id="content-'
                    + createdComment.id
                    + '" class="form-control" name="content" cols="30" rows="1" placeholder="Write a reply...">' + replyUser +'</textarea></div><input type="hidden" name="taggedUser" id="tagged-user-'
                    + createdComment.id
                    +'"><button type="submit" id="submit" class="btn btn-sm btn-common submit-reply-comment" data-id="'
                    + createdComment.id
                    +'" data-parent="'
                    + data.parentCommentId
                    +'">Reply</button></div></div></div></form></div></li>';
                replyComments.append(newCommentHtml).ready(function() {
                    $('.reply-link').css({'cursor': 'pointer'});
                });
            });

            $('#add-to-cart').on('click', function (event) {
                event.preventDefault();
                var courseId = $(this).data('id');
                addCourseToCart(courseId, '{{ __('messages.add_to_cart_success') }}', '{{ __('messages.in_cart_already_failed') }}', '{{ __('messages.my_course_already_failed') }}', '{{ __('messages.my_bill_already_failed') }}', null, 'add-to-cart');
            });

            $('#buy-now').on('click', function (event) {
                event.preventDefault();
                var courseId = $(this).data('id');
                addCourseToCart(courseId, '{{ __('messages.add_to_cart_success_redirecting') }}', '{{ __('messages.in_cart_already_failed') }}', '{{ __('messages.my_course_already_failed') }}', '{{ __('messages.my_bill_already_failed') }}', event.target.id, 'add-to-cart');
            });

            $('#comments').on('click', '#submit-comment', function () {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/courses/' + $('#comment-course-id').val() + '/pusher/postComment',
                    type: 'post',
                    data: {
                        content: $('#comment-content').val(),
                        userId: $('#comment-user-id').val(),
                    },
                    success: function () {
                        $('#comment-content').val('');
                    }
                });
            });
        });

        function replyJavascript() {
            $('#comments').on('click', '.reply-link', function (event) {
                event.preventDefault();
                if ($(this).data('child')) {
                    if ($('#reply-comment-' + $(this).data('id') + '-from-' + $(this).data('child')).css('display') == 'none') {
                        $('#reply-comment-' + $(this).data('id') + '-from-' + $(this).data('child')).show();
                        $('#content-' + $(this).data('child')).focus();
                        $('#content-' + $(this).data('child')).putCursorAtEnd();
                        $('#tagged-user-' + $(this).data('tagged')).val($(this).data('tagged'));
                    } else {
                        $('#reply-comment-' + $(this).data('id') + '-from-' + $(this).data('child')).hide();
                    }
                } else {
                    if ($('#reply-comment-' + $(this).data('id')).css('display') == 'none') {
                        $('#reply-comment-' + $(this).data('id')).show();
                        $('#content-' + $(this).data('id')).focus();
                        $('#content-' + $(this).data('id')).putCursorAtEnd();
                        $('#tagged-user-' + $(this).data('id')).val($(this).data('tagged') + ' ');
                    } else {
                        $('#reply-comment-' + $(this).data('id')).hide();
                    }
                }
            })

            $('#comments').on('click', '.submit-reply-comment, .submit-reply-child-comment', function (event) {
                event.preventDefault();
                var contentComment = '';
                var firstChildComment = true;
                var prevCommentId = 0;

                if($(this).data('id') != undefined) {
                    contentComment = $('#content-' + $(this).data('id')).val();
                    firstChildComment = false;
                    prevCommentId = $(this).data('id');
                } else {
                    if($(this).data('child') != undefined) {
                        contentComment = $('#content-' + $(this).data('child')).val();
                        firstChildComment = false;
                        prevCommentId = $(this).data('child');
                    } else {
                        contentComment = $('#content-' + $(this).data('parent')).val();
                    }
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/courses/' + $('#comment-course-id').val() + '/pusher/replyComment/' + $(this).data('parent'),
                    type: 'post',
                    data: {
                        content: contentComment,
                        userId: $('#comment-user-id').val(),
                        firstChildComment: firstChildComment,
                        prevCommentId: prevCommentId,
                    },
                    success: function (data) {
                        var responseData = jQuery.parseJSON(data);
                        // if not first child comment, get prev comment
                        if(responseData.prevCommentId != null) {
                            $('#content-' + responseData.prevCommentId).val('');

                            $('#reply-comment-' + responseData.parentCommentId + '-from-' + responseData.prevCommentId).hide();
                        } else {
                            var parentCommentId = responseData;
                            $('#content-' + parentCommentId).val('');

                            $('#reply-comment-' + parentCommentId).hide();
                        }
                    }
                });
            });
        }

        // https://css-tricks.com/snippets/jquery/move-cursor-to-end-of-textarea-or-input/
        jQuery.fn.putCursorAtEnd = function () {

            return this.each(function () {

                // Cache references
                var $el = $(this),
                    el = this;

                // Only focus if input isn't already
                if (!$el.is(":focus")) {
                    $el.focus();
                }

                // If this function exists... (IE 9+)
                if (el.setSelectionRange) {

                    // Double the length because Opera is inconsistent about whether a carriage return is one character or two.
                    var len = $el.val().length * 2;

                    // Timeout seems to be required for Blink
                    setTimeout(function () {
                        el.setSelectionRange(len, len);
                    }, 1);

                } else {

                    // As a fallback, replace the contents with itself
                    // Doesn't work in Chrome, but Chrome supports setSelectionRange
                    $el.val($el.val());

                }

                // Scroll to the bottom, in case we're in a tall textarea
                // (Necessary for Firefox and Chrome)
                this.scrollTop = 999999;

            });
        };
    </script>
@endsection
