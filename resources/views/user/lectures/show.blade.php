@extends('user.layouts.default')

@section('inline_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/custom/lectures_show.css') }}">
@endsection

@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="title-2">
                        <strong> {{ __('titles.lecture') . ': ' . \App\Models\Lecture::findOrFail($lectureId)->title }} </strong>
                        @if(!(\Auth::user()->is_admin || \Auth::user()->role == 1))
                            <b style="float: right; padding-right: 30px;">Your
                                progress: {{ $learnedLectureCount }}/{{ $allLectureCount }}</b>
                        @endif
                    </h2>
                    <div class="progress" style="height: 20px">
                        @if(!(\Auth::user()->is_admin || \Auth::user()->role == 1))
                            <div class="progress-bar progress-bar-info" role="progressbar"
                                 aria-valuenow="{{ $learnedLectureCount/$allLectureCount*100 }}"
                                 aria-valuemin="0" aria-valuemax="100"
                                 style="width:{{ $learnedLectureCount/$allLectureCount*100 }}%">
                                {{ round($learnedLectureCount/$allLectureCount*100, 2) }}%
                            </div>
                        @endif
                    </div>
                    {!! $embed->code !!}
                    <div id="timer" style="display: none;">
                        <p class="text-center" style="font-weight: bold">Redirect to next lecture
                            <i>{{ \App\Models\Lecture::findOrFail($lectureId + 1)->title }}</i> in <span
                                    id="timer-text"></span>s</p>
                    </div>
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
                    <br>
                    <div id="comments">
                        <div class="inner-box">
                            <h3>Comments ({{ $lectureComments->count() }})</h3>
                            <ol class="comments-list" id="comment-list">
                                @foreach($lectureComments as $comment)
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
                                        <div class="reply-comment" style="display: none"
                                             id="reply-comment-{{ $comment->id }}">
                                            <form>
                                                <div class="row">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <div class="row">
                                                        <div class=" col-md-10 pull-right">
                                                            <div class="form-group">
                        <textarea id="content-{{ $comment->id }}" class="form-control" name="content" cols="30"
                                  rows="1"
                                  placeholder="Write a reply...">@if($comment->user->name !== \Auth::user()->name) {{ $comment->user->name }} @endif</textarea>
                                                            </div>
                                                            <input type="hidden" name="taggedUser"
                                                                   id="tagged-user-{{ $comment->id }}">
                                                            <button type="submit" id="submit"
                                                                    class="btn btn-sm btn-common submit-reply-comment"
                                                                    data-parent="{{ $comment->id }}">
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
                                                            <a href="{{ route('users.show', $comment->user->id) }}">
                                                                <img alt="{{ $child_comment->user->name }}"
                                                                     style="height: 75px; width: 75px"
                                                                     src="{{ str_replace('public/', '', asset($child_comment->user->avatar)) }}"/>
                                                            </a>
                                                        </div>
                                                        <div class="info-body">
                                                            <div class="media-heading">
                                                                <h4 class="name">{{ $child_comment->user->name }}</h4> |
                                                                <span class="comment-date">{{ $child_comment->updated_at }}</span>
                                                                <a class="reply-link" data-id="{{ $comment->id }}"
                                                                   data-tagged="{{ $child_comment->user->id }}"
                                                                   data-child="{{ $child_comment->id }}"><i
                                                                            class="fa fa-reply-all"></i> Reply </a>
                                                            </div>
                                                            <p>{!! $child_comment->content !!} </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <br>
                                                <div class="reply-comment" style="display: none"
                                                     id="reply-comment-{{ $comment->id }}-from-{{ $child_comment->id }}">
                                                    <form>
                                                        <div class="row">
                                                            @csrf
                                                            <input type="hidden" name="user_id"
                                                                   value="{{ Auth::user()->id }}">
                                                            <div class="row">
                                                                <div class=" col-md-12 pull-right">
                                                                    <div class="form-group">
                        <textarea id="content-{{ $child_comment->id }}" class="form-control" name="content" cols="30"
                                  rows="1"
                                  placeholder="Write a reply...">@if($child_comment->user->name !== \Auth::user()->name) {{ $child_comment->user->name }} @endif</textarea>
                                                                    </div>
                                                                    <input type="hidden" name="taggedUser"
                                                                           id="tagged-user-{{ $child_comment->user->id }}">
                                                                    <button type="submit" id="submit"
                                                                            class="btn btn-sm btn-common submit-reply-child-comment"
                                                                            data-child="{{ $child_comment->id }}"
                                                                            data-parent="{{ $comment->id }}">
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
                                <h2 class="respond-title">Write a comment for lecture
                                    <b> {{ \App\Models\Lecture::findOrFail($lectureId)->title }} </b></h2>
                                <form>
                                    <div class="row">
                                        <input type="hidden" id="comment-lecture-id" value="{{ $lectureId }}">
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

                <aside id="sidebar" class="col-md-4 right-sidebar">

                    <div class="widget">
                        <div class="categories">
                            <div class="widget-title">
                                <button class="btn btn-sm" id="active-all-lecture"
                                        onclick="openTab('all-lecture')"> {{ __('titles.all_lecture') }} </button>
                                <button class="btn btn-sm" id="active-discussion" style="background-color: #7cbde9"
                                        onclick="openTab('discussion')"> {!! __('titles.discussion') . ' (<span id="discussion-count">' . $discussionsList->count() . '</span>)' !!}</button>
                            </div>
                            <div class="categories-list tab" id="all-lecture">
                                @for($i = 0; $i < $maxWeek; $i++)
                                    <br>
                                    <h4>Week {{ $i + 1 }}</h4>
                                    <ul>
                                        @foreach($lectureOutline[$i] as $lecture)
                                            <li>
                                                <a class="@if($lecture->id == $lectureId) selected @endif"
                                                   href="{{ (\App\Models\QuizResult::where('lecture_id', $lecture->id)->where('user_id', \Auth::user()->id)->first()) ? url('/courses/' . $id . '/lectures/' . $lecture->id . '/getResult') : url('/courses/' . $id . '/lectures/' . $lecture->id) }}">
                                                    <i class="fa {{ $lecture->status ? 'fa-star' : 'fa-star-o' }}"></i>
                                                    @if($lecture->id == $lectureId)
                                                        {!! '<span><strong>' . $lecture->title . '</strong></span>' !!}
                                                    @else
                                                        {{ $lecture->title }}
                                                    @endif
                                                    <span class="category-counter"> {{ $lecture->duration }} </span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endfor
                            </div>
                            <div class="categories-list tab" id="discussion" style="display: none">
                                <div class="panel-body-chat" id="discussion-scroll">
                                    <ul class="chat" id="discussions-list">
                                        @if($discussionsList->count() != 0)
                                            @foreach($discussionsList as $discussion)
                                                <li class="left clearfix"><span class="chat-img pull-left">
                                                <img style="height: 50px; width: 50px"
                                                     src="{{ str_replace('public/', '', asset($discussion->user->avatar)) }}"
                                                     alt="User Avatar"
                                                     class="img-circle"/>
                                                </span>
                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <strong class="primary-font">{{ $discussion->user->name }}</strong>
                                                            <small class="pull-right text-muted diff-time"
                                                                   id="time-{{ $discussion->id }}"
                                                                   data-time="{{ strtotime($discussion->created_at) }}">
                                                                <span class="glyphicon glyphicon-time"></span> {{ \Carbon\Carbon::parse($discussion->created_at)->diffForHumans() }}
                                                            </small>
                                                        </div>
                                                        <p>
                                                            {{ $discussion->content }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <p id="no-discussion">{{ __('titles.no_discussion') }}</p>
                                        @endif
                                    </ul>
                                </div>
                                <div class="panel-footer">
                                    <div class="input-group">
                                        <input id="input-content" type="text" class="input-sm pull-right"
                                               style="width: 100%" placeholder="Type your discussion ..."/>
                                        <span class="input-group-btn">
                                            <input type="hidden" id="current-user" value="{{ Auth::user()->id }}">
                                            <input type="hidden" id="lecture-id" value="{{ $lectureId }}">
                                            <button class="btn btn-warning btn-sm" id="btn-chat"
                                                    style="background-color: #3498db">
                                                Send</button>
                                        </span>
                                    </div>
                                </div>
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
            $('#btn-chat').on('click', function (event) {
                event.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/discussions/pusher/pushNewDiscussion',
                    type: 'post',
                    data: {
                        content: $('#input-content').val(),
                        lectureId: $('#lecture-id').val(),
                        userId: $('#current-user').val(),
                    },
                    success: function (data) {
                        $('#input-content').val('');
                    }
                });
            })

            $('#active-all-lecture').on('click', function () {
                $(this).removeAttr('style');
                $('#active-discussion').attr('style', 'background-color: #7cbde9');
            })

            $('#active-discussion').on('click', function () {
                $(this).removeAttr('style');
                $('#active-all-lecture').attr('style', 'background-color: #7cbde9');
                $("#discussion-scroll").animate({scrollTop: $('#discussion-scroll').prop("scrollHeight")}, 'slow');
                $('#input-content').focus();
            })

            // Thay giá trị PUSHER_APP_KEY vào chỗ xxx này nhé
            var pusher = new Pusher('f2b354d9cdae3999c31d', {
                encrypted: true,
                cluster: "ap1"
            });

            // Subscribe to the channel we specified in our Laravel Event
            var channel = pusher.subscribe('discussion');

            // Bind a function to a Event (the full Laravel class)
            channel.bind('App\\Events\\GetDiscussionFromPusherEvent', function (data) {
                if ($('#no-discussion').length) {
                    $('#no-discussion').hide();
                }
                var discussionArea = $('#discussions-list');
                var userImage = data.userAvatar;
                var newDiscussionHtml = '<li class="left clearfix"><span class="chat-img pull-left"><img style="height: 50px; width: 50px" src="'
                    + userImage
                    + '" alt="User Avatar" class="img-circle"/></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font">'
                    + data.userName
                    + '</strong><small class="pull-right text-muted diff-time" id="time-'
                    + data.createdDiscussionId +
                    '" data-time="' +
                    new Date().getTime() / 1000 +
                    '"><span class="glyphicon glyphicon-time"></span></small></div><p>'
                    + data.content
                    + '</p></div></li>';
                discussionArea.append(newDiscussionHtml).ready(function () {
                    $("#discussion-scroll").animate({scrollTop: $('#discussion-scroll').prop("scrollHeight")}, 'slow');
                    $('#input-content').focus();
                    clearInterval(myTimer);
                    myTimer = setInterval(updateTime, 3000);
                });

                // Discussion count up 1
                var oldCount = $('#discussion-count').text();
                $('#discussion-count').text(parseInt(oldCount) + 1);
            });

            //test area
            $('.reply-link').css({'cursor': 'pointer'});

            replyJavascript();

            // Pusher area
            var comments = $('#comment-list');

            // Subscribe to the channel we specified in our Laravel Event
            var channelComment = pusher.subscribe('lecture-comment');

            // Bind a function to a Event (the full Laravel class)
            channelComment.bind('App\\Events\\GetLectureCommentFromPusherEvent', function (data) {
                var commentedUser = jQuery.parseJSON(data.user);
                var userAvatar = commentedUser.avatar;
                userAvatar = userAvatar.replace("images/", "http://127.0.0.1:8000/images/");
                var createdLectureComment = jQuery.parseJSON(data.createdLectureComment);
                var newCommentHtml =
                    '<li id="li-comment-' + createdLectureComment.id + '"><div class="media"><div class="thumb-left"><img alt="'
                    + commentedUser.name +
                    '" style="height: 75px; width: 75px" src="'
                    + userAvatar +
                    '"/></a></div><div class="info-body"><div class="media-heading"><h4 class="name">'
                    + commentedUser.name +
                    '</h4><span class="comment-date">'
                    + createdLectureComment.updated_at +
                    '</span> <a class="reply-link" data-id="'
                    + createdLectureComment.id +
                    '" data-tagged="'
                    + createdLectureComment.user_id
                    + '"><i class="fa fa-reply-all"></i> Reply</a> </div>'
                    + data.content +
                    '</div></div><br><div class="reply-comment" style="display: none" id="reply-comment-'
                    + createdLectureComment.id +
                    '"><form><div class="row">@csrf<div class="row"> <div class=" col-md-10 pull-right"> <div class="form-group"> <textarea id="content-'
                    + createdLectureComment.id +
                    '" class="form-control" name="content" cols="30"rows="1" placeholder="Write a reply..."></textarea> </div> <input type="hidden" name="taggedUser" id="tagged-user-'
                    + createdLectureComment.id +
                    '"><button type="submit" id="submit" class="btn btn-sm btn-common submit-reply-comment" data-parent="'
                    + createdLectureComment.id +
                    '">Reply </button> </div> </div> </div> </form></div><ul id="reply-comment-'
                    + createdLectureComment.id +
                    '-list"></ul></li>';
                comments.append(newCommentHtml).ready(function () {
                    $('.reply-link').css({'cursor': 'pointer'});
                });
            });

            // Subscribe to the channel we specified in our Laravel Event
            var channelReplyLectureComment = pusher.subscribe('replyLectureComment');

            // Bind a function to a Event (the full Laravel class)
            channelReplyLectureComment.bind('App\\Events\\GetReplyLectureCommentFromPusherEvent', function (data) {
                var replyLectureComments = $('#reply-comment-' + data.parentCommentId + '-list');
                var commentedUser = jQuery.parseJSON(data.user);
                var userAvatar = commentedUser.avatar;
                userAvatar = userAvatar.replace("images/", "http://127.0.0.1:8000/images/");
                var createdComment = jQuery.parseJSON(data.createdComment);
                var replyUser = '';
                var currentUserId = '{{ \Auth::user()->id }}';
                if (commentedUser.id != currentUserId) {
                    replyUser = commentedUser.name;
                }
                var newLectureCommentHtml = '<li> <div class="media"><div class="thumb-left"><img alt="'
                    + commentedUser.name +
                    '" style="height: 75px; width: 75px" src="'
                    + userAvatar +
                    '"/></a></div><div class="info-body"><div class="media-heading"><h4 class="name">'
                    + commentedUser.name +
                    '</h4><span class="comment-date">'
                    + createdComment.updated_at +
                    '</span><a class="reply-link" data-id="' + data.parentCommentId + '" data-child="' + createdComment.id + '" data-tagged="'
                    + createdComment.user_id +
                    '"><i class="fa fa-reply-all"></i> Reply</a></div>'
                    + data.content +
                    '</div></div><br><div class="reply-comment" style="display: none" id="reply-comment-' + data.parentCommentId + '-from-'
                    + createdComment.id
                    + '"><form><div class="row">@csrf<div class="row"><div class=" col-md-12 pull-right"><div class="form-group"><textarea id="content-'
                    + createdComment.id
                    + '" class="form-control" name="content" cols="30" rows="1" placeholder="Write a reply...">' + replyUser + '</textarea></div><input type="hidden" name="taggedUser" id="tagged-user-'
                    + createdComment.id
                    + '"><button type="submit" id="submit" class="btn btn-sm btn-common submit-reply-comment" data-id="'
                    + createdComment.id
                    + '" data-parent="'
                    + data.parentCommentId
                    + '">Reply</button></div></div></div></form></div></li>';
                replyLectureComments.append(newLectureCommentHtml).ready(function () {
                    $('.reply-link').css({'cursor': 'pointer'});
                });
            });

            $('#comments').on('click', '#submit-comment', function (event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/lectures/' + $('#comment-lecture-id').val() + '/pusher/postComment',
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

        function openTab(tab) {
            $('.tab').attr('style', 'display:none');
            $('#' + tab).attr('style', 'display:block');
        }

        // test area
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

                if ($(this).data('id') != undefined) {
                    contentComment = $('#content-' + $(this).data('id')).val();
                    firstChildComment = false;
                    prevCommentId = $(this).data('id');
                } else {
                    if ($(this).data('child') != undefined) {
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
                    url: '/lectures/' + $('#comment-lecture-id').val() + '/pusher/replyLectureComment/' + $(this).data('parent'),
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
                        if (responseData.prevCommentId != null) {
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


        // Get end of youtube video
        $('iframe').attr('id', 'player');
        var old = $('iframe').attr('src');
        $('iframe').attr('src', old + '&enablejsapi=1');

        // 2. This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates an <iframe> (and YouTube player)
        //    after the API code downloads.
        var player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '370',
                width: '750',
                videoId: 'M7lc1UVf-VE',
                events: {
                    'onStateChange': onPlayerStateChange,
                }
            });
        }

        // 5. The API calls this function when the player's state changes.
        //    The function indicates that when playing a video (state=1),
        //    the player should play for six seconds and then stop.
        var done = false;

        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.ENDED) {
                var lectureId = '{{ $lectureId }}';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/lectures/' + lectureId + '/user/' + $('#comment-user-id').val() + '/changeProcessStatus',
                    type: 'post',
                    success: function (data) {
                        var responseData = jQuery.parseJSON(data);
                        if (responseData.isLastLecture == 1) {
                            $.notify({
                                // options
                                message: 'Congratulations ! You have completed this course.'
                            }, {
                                // settings
                                type: 'success',
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                },
                            });
                        } else if (responseData.isLastLecture == 0) {
                            var redirectUrl = '/courses/' + responseData.inCourseId + '/lectures/' + responseData.nextLecture.id;
                            $.notify({
                                // options
                                message: 'You have completed this lecture. Redirect to next lecture: <b>' + responseData.nextLecture.title + '</b>',
                                url: redirectUrl,
                                target: "_self"
                            }, {
                                // settings
                                type: 'success',
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                },
                                delay: 10000
                            });
                            $('#timer').show();
                            setTimeout(function () {
                                window.location.replace(redirectUrl);
                            }, 10000);
                            var timer = 11;
                            setInterval(function () {
                                timer = timer - 1;
                                $oldText = $
                                $('#timer-text').text(timer);
                            }, 1000)
                        }
                    }
                });
            }
        }
    </script>
@endsection
