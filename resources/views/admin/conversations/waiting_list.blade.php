@extends('admin.layouts.default')

@section('title')
    {{ __('titles.waiting_conversations') }}
@endsection

@section('inline_styles')
    {{--    <link rel="stylesheet"--}}
    {{--          href="{{ asset('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css') }}"/>--}}
@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="chat chat-app row">
                <div class="chat-list">
                    <div class="chat-user-tool">
                        <i class="search-icon mdi mdi-magnify p-r-10 font-size-20"></i>
                        <input placeholder="Search">
                    </div>
                    <div class="chat-user-list scrollable">
                        <div class="m-b-30 m-t-20">
                            <h6 class="p-h-20 text-uppercase text-semibold">In progress</h6>
                            <ul class="list-media" id="side-bar-in-progress-conversation">
                                @foreach($inProgressConversationList as $conversation)
                                    <li class="list-item" id="sidebar-conversation-{{ $conversation->id }}"
                                        data-id="{{ $conversation->id }}">
                                        <a href="javascript:void(0);" class="conversation-toggler media-hover p-h-20">
                                            <div class="media-img">
                                                <img src="{{ str_replace('public/', '', asset(\App\Models\User::findOrFail($conversation->user_sender_id)->avatar)) }}"
                                                     alt="">
                                                <span class="status success"
                                                      id="span-status-conversation-{{ $conversation->id }}"></span>
                                            </div>
                                            <div class="info">
                                                <span class="title p-t-10">{{ \App\Models\User::findOrFail($conversation->user_sender_id)->name }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="m-b-30">
                            <h6 class="p-h-20 text-uppercase text-semibold">Waiting</h6>
                            <ul class="list-media" id="waiting-area">
                                @foreach($waitingConversationList as $conversation)
                                    <li class="list-item" id="sidebar-conversation-{{ $conversation->id }}"
                                        data-id="{{ $conversation->id }}">
                                        <a href="javascript:void(0);" class="conversation-toggler media-hover p-h-20">
                                            <div class="media-img">
                                                <img src="{{ str_replace('public/', '', asset(\App\Models\User::findOrFail($conversation->user_sender_id)->avatar)) }}"
                                                     alt="">
                                                <span class="status away"
                                                      id="span-status-conversation-{{ $conversation->id }}"></span>
                                            </div>
                                            <div class="info">
                                                <span class="title p-t-10">{{ \App\Models\User::findOrFail($conversation->user_sender_id)->name }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="m-b-30">
                            <h6 class="p-h-20 text-uppercase text-semibold">Done</h6>
                            <ul class="list-media" id="side-bar-done-conversation">
                                @foreach($waitingConversationList as $conversation)
                                    <li class="list-item" id="sidebar-conversation-{{ $conversation->id }}"
                                        data-id="{{ $conversation->id }}">
                                        <a href="javascript:void(0);" class="conversation-toggler media-hover p-h-20">
                                            <div class="media-img">
                                                <img src="{{ str_replace('public/', '', asset(\App\Models\User::findOrFail($conversation->user_sender_id)->avatar)) }}"
                                                     alt="">
                                                <span class="status busy"
                                                      id="span-status-conversation-{{ $conversation->id }}"></span>
                                            </div>
                                            <div class="info">
                                                <span class="title p-t-10">{{ \App\Models\User::findOrFail($conversation->user_sender_id)->name }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @foreach($waitingConversationList as $conversation)
                    <div class="chat-content" id="conversation-box">
                        <div class="conversation" id="conversation-box-{{ $conversation->id }}"
                             style="{{ $conversation->id == $waitingConversationList->first()->id ? '' : 'display:none' }}">
                            <div class="conversation-wrapper">
                                <div class="conversation-header">
                                    <span class="recipient"> {{ \App\Models\User::findOrFail($conversation->user_sender_id)->name }} </span>
                                    <ul class="tools">
                                        <li>
                                            <a class="text-gray" href="javascript:void(0)">
                                                <i id="icon-change-status-{{ $conversation->id }}"
                                                   class="mdi mdi-chart-bubble change-status"
                                                   data-id="{{ $conversation->id }}"
                                                   data-status="{{ $conversation->status }}"></i>
                                            </a>
                                        </li>
                                        <li class="d-md-none">
                                            <a class="text-gray conversation-toggler" href="javascript:void(0)">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="conversation-body scrollable" id="conversation-body-{{ $conversation->id }}"
                                     style="overflow: auto!important">
                                    <div class="msg datetime">
                                        <span>Today</span>
                                    </div>
                                    @foreach(\App\Models\ConversationMessage::where('conversation_id', $conversation->id)->orderBy('created_at')->get() as $message)
                                        <div class="msg msg-{{ \App\Models\User::findOrFail($message->from_id)->is_admin ? 'sent' : 'recipient' }}">
                                            @if(!\App\Models\User::findOrFail($message->from_id)->is_admin)
                                                <div class="user-img">
                                                    <img src="{{ str_replace('public', '', asset(\App\Models\User::findOrFail($message->from_id)->avatar)) }}"
                                                         alt="">
                                                </div>
                                            @endif
                                            <div class="bubble">
                                                <div class="bubble-wrapper">
                                                    <span>{{ $message->content }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="conversation-footer">
                                    <button class="upload-btn">
                                        <i class="ti-face-smile"></i>
                                    </button>
                                    <input class="chat-input" id="message-content-{{ $conversation->id }}" type="text"
                                           placeholder="Type a message...">
                                    <button class="sent-btn" data-id="{{ $conversation->id }}">
                                        <i class="fa fa-send-o"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @foreach($inProgressConversationList as $conversation)
                    <div class="chat-content" id="conversation-box">
                        <div class="conversation" id="conversation-box-{{ $conversation->id }}"
                             style="{{ $conversation->id == $waitingConversationList->first()->id ? '' : 'display:none' }}">
                            <div class="conversation-wrapper">
                                <div class="conversation-header">
                                    <span class="recipient"> {{ \App\Models\User::findOrFail($conversation->user_sender_id)->name }} </span>
                                    <ul class="tools">
                                        <li>
                                            <a class="text-gray" href="javascript:void(0)">
                                                <i id="icon-change-status-{{ $conversation->id }}"
                                                   class="mdi mdi-check change-status"
                                                   data-id="{{ $conversation->id }}"
                                                   data-status="{{ $conversation->status }}"></i>
                                            </a>
                                        </li>
                                        <li class="d-md-none">
                                            <a class="text-gray conversation-toggler" href="javascript:void(0)">
                                                <i class="mdi mdi-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="conversation-body scrollable" id="conversation-body-{{ $conversation->id }}"
                                     style="overflow: auto!important">
                                    <div class="msg datetime">
                                        <span>Today</span>
                                    </div>
                                    @foreach(\App\Models\ConversationMessage::where('conversation_id', $conversation->id)->orderBy('created_at')->get() as $message)
                                        <div class="msg msg-{{ \App\Models\User::findOrFail($message->from_id)->is_admin ? 'sent' : 'recipient' }}">
                                            @if(!\App\Models\User::findOrFail($message->from_id)->is_admin)
                                                <div class="user-img">
                                                    <img src="{{ str_replace('public', '', asset(\App\Models\User::findOrFail($message->from_id)->avatar)) }}"
                                                         alt="">
                                                </div>
                                            @endif
                                            <div class="bubble">
                                                <div class="bubble-wrapper">
                                                    <span>{{ $message->content }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="conversation-footer">
                                    <button class="upload-btn">
                                        <i class="ti-face-smile"></i>
                                    </button>
                                    <input class="chat-input" id="message-content-{{ $conversation->id }}" type="text"
                                           placeholder="Type a message...">
                                    <button class="sent-btn" data-id="{{ $conversation->id }}">
                                        <i class="fa fa-send-o"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->
@endsection

@section('inline_scripts')
    <script src="{{ asset('assets/admin/js/apps/chat.js') }}"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.chat-app').on('click', '.change-status', function (e) {
                e.preventDefault();
                var status = $(this).data('status');
                if (status == 0) {
                    var moveStatus = 1;
                    $.notify({
                        // options
                        message: ' {{ __('messages.move_waiting_to_in_progress') }} '
                    }, {
                        // settings
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });
                } else if (status == 1) {
                    var moveStatus = 2;
                    $.notify({
                        // options
                        message: ' {{ __('messages.move_in_progress_to_done') }} '
                    }, {
                        // settings
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });
                } else if (status == 2) {
                    var moveStatus = 1;
                    $.notify({
                        // options
                        message: ' {{ __('messages.move_done_to_in_progress') }} '
                    }, {
                        // settings
                        type: 'success',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                    });
                }
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                });
                $.ajax({
                    url: '/conversations/' + $(this).data('id') + '/changeConversationStatus',
                    type: "post",
                    data: {
                        status: moveStatus,
                    }
                });
                var sideBarConversationHtml = $("<div/>").append($('#sidebar-conversation-' + $(this).data('id')).clone()).html();
                $('#sidebar-conversation-' + $(this).data('id')).remove();
                if (status == 0) {
                    $('#side-bar-in-progress-conversation').prepend(sideBarConversationHtml);
                    $('#span-status-conversation-' + $(this).data('id')).removeClass('away');
                    $('#span-status-conversation-' + $(this).data('id')).addClass('success');
                    $('#icon-change-status-' + $(this).data('id')).removeClass('mdi-chart-bubble');
                    $('#icon-change-status-' + $(this).data('id')).addClass('mdi-check');
                    $(this).data('status', 1);
                } else if (status == 1) {
                    $('#side-bar-done-conversation').prepend(sideBarConversationHtml);
                    $('#span-status-conversation-' + $(this).data('id')).removeClass('success');
                    $('#span-status-conversation-' + $(this).data('id')).addClass('busy');
                    $('#icon-change-status-' + $(this).data('id')).removeClass('mdi-check');
                    $('#icon-change-status-' + $(this).data('id')).addClass('mdi-chart-bubble');

                    $(this).data('status', 2);

                } else if (status == 2) {
                    $('#side-bar-in-progress-conversation').prepend(sideBarConversationHtml);
                    $('#span-status-conversation-' + $(this).data('id')).removeClass('busy');
                    $('#span-status-conversation-' + $(this).data('id')).addClass('success');
                    $('#icon-change-status-' + $(this).data('id')).removeClass('mdi-chart-bubble');
                    $('#icon-change-status-' + $(this).data('id')).addClass('mdi-check');

                    $(this).data('status', 1);
                }
            })

            $('ul.list-media').on('click', 'li', function (e) {
                e.preventDefault();
                var conversationId = $(this).data('id');
                $('.conversation').each(function () {
                    $(this).fadeOut(300);
                });
                var conversationBoxHtml = $("<div/>").append($('#conversation-box-' + conversationId).clone()).html();
                $('#conversation-box').prepend(conversationBoxHtml);
                $('#conversation-box-' + conversationId).fadeIn(300);
                $('.conversation-body').each(function () {
                    updateScroll(this.id);
                });
            })

            $('.chat-app').on('click', '.sent-btn', function (e) {
                e.preventDefault();
                var adminId = '{{ Auth::user()->id }}'
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                });
                $.ajax({
                    url: '/conversations/' + $(this).data('id') + '/storeNewMessage',
                    type: "post",
                    data: {
                        from_id: adminId,
                        content: $('#message-content-' + $(this).data('id')).val(),
                    }
                });
                var newMessageHtml = '<div class="msg msg-sent">\n' +
                    '                                            <div class="bubble">\n' +
                    '                                                <div class="bubble-wrapper">\n' +
                    '                                                    <span>' + $('#message-content-' + $(this).data('id')).val() +
                    '</span>\n' +
                    '                                                </div>\n' +
                    '                                            </div>\n' +
                    '                                        </div>';
                $('#conversation-body-' + $(this).data('id')).append(newMessageHtml);
                $('#message-content-' + $(this).data('id')).val('');
                $('.conversation-body').each(function () {
                    updateScroll(this.id);
                });
            })

            $('.conversation-body').each(function () {
                updateScroll(this.id);
            });

            // Conversation area
            // custom notification
            var pusher = new Pusher("f2b354d9cdae3999c31d", {
                encrypted: true,
                cluster: "ap1"
            });

            var conversationMessageChannel = pusher.subscribe("conversation-message");

            conversationMessageChannel.bind(
                "App\\Events\\GetConversationMessageFromPusherEvent",
                function (data) {
                    var is_in_progress = data.is_in_progress;
                    var userAvatar = data.fromUser.avatar;
                    userAvatar = userAvatar.replace(
                        "images/",
                        "http://127.0.0.1:8000/images/"
                    );
                    if (is_in_progress) {
                        var currentAdminId = '{{ \Auth::user()->id }}';
                        if(data.fromUser.id != currentAdminId) {
                            var newMessageHtml = '<div class="msg msg-recipient">\n' +
                                '                                                <div class="user-img">\n' +
                                '                                                    <img src="' + userAvatar +
                                '"\n' +
                                '                                                         alt="">\n' +
                                '                                                </div>\n' +
                                '                                            \n' +
                                '                                            <div class="bubble">\n' +
                                '                                                <div class="bubble-wrapper">\n' +
                                '                                                    <span>' + data.message.content +
                                '</span>\n' +
                                '                                                </div>\n' +
                                '                                            </div>\n' +
                                '                                        </div>';
                            var conversation = $('#conversation-body-' + data.message.conversation_id);
                            conversation.append(newMessageHtml);
                        }
                        $('.conversation-body').each(function () {
                            updateScroll(this.id);
                        });
                    } else {
                        var newMessageHtml = '<div class="msg msg-recipient">\n' +
                            '                                                <div class="user-img">\n' +
                            '                                                    <img src="' + userAvatar +
                            '"\n' +
                            '                                                         alt="">\n' +
                            '                                                </div>\n' +
                            '                                            \n' +
                            '                                            <div class="bubble">\n' +
                            '                                                <div class="bubble-wrapper">\n' +
                            '                                                    <span>' + data.message.content +
                            '</span>\n' +
                            '                                                </div>\n' +
                            '                                            </div>\n' +
                            '                                        </div>';
                        var conversation = $('#conversation-body-' + data.message.conversation_id);
                        if (!conversation.length) {
                            var newConversationHtml = '<div class="chat-content" id="conversation-box">\n' +
                                '                        <div class="conversation" id="conversation-box-' + data.message.conversation_id +
                                '"\n' +
                                '                             style="display:none">\n' +
                                '                            <div class="conversation-wrapper">\n' +
                                '                                <div class="conversation-header">\n' +
                                '                                    <span class="recipient"> ' + data.fromUser.name +
                                ' </span>\n' +
                                '                                    <ul class="tools">\n' +
                                '                                        <li>\n' +
                                '                                            <a class="text-gray" href="javascript:void(0)">\n' +
                                '                                                <i id="icon-change-status-' + data.message.conversation_id +
                                '"\n' +
                                '                                                   class="mdi mdi-chart-bubble change-status"\n' +
                                '                                                   data-id="' + data.message.conversation_id +
                                '"\n' +
                                '                                                   data-status="0"></i>\n' +
                                '                                            </a>\n' +
                                '                                        </li>\n' +
                                '                                        <li class="d-md-none">\n' +
                                '                                            <a class="text-gray conversation-toggler" href="javascript:void(0)">\n' +
                                '                                                <i class="mdi mdi-chevron-right"></i>\n' +
                                '                                            </a>\n' +
                                '                                        </li>\n' +
                                '                                    </ul>\n' +
                                '                                </div>\n' +
                                '                                <div class="conversation-body scrollable" id="conversation-body-' + data.message.conversation_id +
                                '"\n' +
                                '                                     style="overflow: auto!important">\n' +
                                '                                    <div class="msg datetime">\n' +
                                '                                        <span>Today</span>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                                <div class="conversation-footer">\n' +
                                '                                    <button class="upload-btn">\n' +
                                '                                        <i class="ti-face-smile"></i>\n' +
                                '                                    </button>\n' +
                                '                                    <input class="chat-input" id="message-content-' + data.message.conversation_id +
                                '" type="text"\n' +
                                '                                           placeholder="Type a message...">\n' +
                                '                                    <button class="sent-btn" data-id="' + data.message.conversation_id +
                                '">\n' +
                                '                                        <i class="fa fa-send-o"></i>\n' +
                                '                                    </button>\n' +
                                '                                </div>\n' +
                                '                            </div>\n' +
                                '                        </div>\n' +
                                '                    </div>';
                            $('.chat-app').append(newConversationHtml);
                            $('#conversation-body-' + data.message.conversation_id).append(newMessageHtml);
                            var newWaitingConversationHtml = '<li class="list-item" id="sidebar-conversation-' + data.message.conversation_id +
                                '"\n' +
                                '                                        data-id="' + data.message.conversation_id +
                                '">\n' +
                                '                                        <a href="javascript:void(0);" class="conversation-toggler media-hover p-h-20">\n' +
                                '                                            <div class="media-img">\n' +
                                '                                                <img src="' + userAvatar +
                                '"\n' +
                                '                                                     alt="">\n' +
                                '                                                <span class="status away"\n' +
                                '                                                      id="span-status-conversation-' + data.message.conversation_id +
                                '"></span>\n' +
                                '                                            </div>\n' +
                                '                                            <div class="info">\n' +
                                '                                                <span class="title p-t-10">' + data.fromUser.name +
                                '</span>\n' +
                                '                                            </div>\n' +
                                '                                        </a>\n' +
                                '                                    </li>';
                            $('#waiting-area').prepend(newWaitingConversationHtml);
                        } else {
                            conversation.append(newMessageHtml);
                        }
                        $('.conversation-body').each(function () {
                            updateScroll(this.id);
                        });
                    }
                }
            );
        })

        function updateScroll(elementId) {
            document.getElementById(elementId).scrollTop = 9999999;
        }
    </script>
@endsection
