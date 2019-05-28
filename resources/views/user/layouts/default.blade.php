<!DOCTYPE html>
<html lang="en">
@include('user.layouts.head')
@yield('inline_styles')
<body>
@include('user.layouts.header')
<!--Content-->
@yield('content')
<!--./Content -->

@if(\Auth::user())
<div class="popup-box chat-popup" id="qnimate">
    <div class="popup-head">
        <div class="popup-head-left pull-left"><img
                    src="{{ asset('assets/img/logo-short.png') }}"
                    alt="iamgurdeeposahan"> R2S ADMIN
        </div>
        <div class="popup-head-right pull-right">
            <button data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><i
                        class="glyphicon glyphicon-minus"></i></button>
        </div>
    </div>
    <div class="popup-messages" id="popup-messages">
        <div class="direct-chat-messages" id="conversation-list" style="overflow: auto">
            @php
                $conversation = \App\Models\Conversation::where('user_sender_id', \Auth::user()->id)->first();
                if($conversation) {
                    $messageList = $conversation->conversation_messages;
                }
            @endphp
            @if(isset($messageList))
                <div class="chat-box-single-line">
                    <abbr class="timestamp">Today</abbr>
                </div>
                @foreach($messageList as $message)
                    <div class="direct-chat-msg doted-border">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left">{{ \App\Models\User::findOrFail($message->from_id)->name }}</span>
                        </div>
                        <!-- /.direct-chat-info -->
                        <img alt="iamgurdeeposahan"
                             src="{{ str_replace("public/", "", asset(\App\Models\User::findOrFail($message->from_id)->avatar)) }}"
                             class="direct-chat-img"><!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            {{ $message->content }}
                        </div>
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-timestamp pull-right">{{ $message->created_at->toTimeString() }}</span>
                        </div>
                    </div>
                @endforeach
                @else
                <p class="text-center"> Start Conversation with Admin</p>
            @endif
        </div>
    </div>
    <div class="popup-messages-footer">
        <textarea id="status_message" placeholder="Type a message..." rows="2" cols="40" name="message"></textarea>
        <input type="hidden" value="{{ \Auth::user()->id }}" id="sender-id">
        {{--        <input type="submit"--}}
        {{--               style="position: absolute; left: -9999px; width: 1px; height: 1px;"--}}
        {{--               tabindex="-1"/>--}}
        {{--        <span class="input-group-btn">--}}
        {{--            <button class="btn btn-warning btn-sm pull-right" id="btn-chat"--}}
        {{--                    style="background-color: #3498db">--}}
        {{--                Send</button>--}}
        {{--        </span>--}}
        {{--        <button class="bg_none pull-right"><i class="glyphicon glyphicon-thumbs-up"></i></button>--}}
        {{--        <div class="btn-footer">--}}
        {{--            <button class="bg_none"><i class="glyphicon glyphicon-film"></i></button>--}}
        {{--            <button class="bg_none"><i class="glyphicon glyphicon-camera"></i></button>--}}
        {{--            <button class="bg_none"><i class="glyphicon glyphicon-paperclip"></i></button>--}}
        {{--            <button class="bg_none pull-right"><i class="glyphicon glyphicon-thumbs-up"></i></button>--}}
        {{--        </div>--}}
    </div>
</div>
@endif
@include('user.layouts.footer')
@yield('inline_scripts')
</body>
</html>
