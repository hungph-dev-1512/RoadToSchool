@extends('user.layouts.default')

@section('title')
    {{ __('titles.notification') }}
@endsection

@section('inline_styles')
@endsection

@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                @include('user.partials.user_management_info')
                <div class="col-sm-9 page-content">
                    <div class="inner-box">
                        <h2 class="title-2"><i class="fa fa-bell"></i> {{ __('titles.notification') }} </h2>
                        <div class="table-responsive">
                            <div class="table-action">
                                {{--                                <div class="checkbox">--}}
                                {{--                                    <label for="checkAll">--}}
                                {{--                                        <input id="checkAll" type="checkbox">--}}
                                @php
                                    $currentPage = $notificationList->currentPage();
                                    $lastItemIndex = $notificationList->lastItem();
                                    $startIndex = 12*($currentPage-1) + 1;
                                    if($currentPage == $notificationList->lastPage())
                                    {
                                        $endIndex = $lastItemIndex;
                                    } else {
                                        $endIndex = $startIndex+11;
                                    }
                                @endphp
                                <b>Total:</b> {{ $notificationList->total() }} |
                                <b>Unread:</b> {{ $unreadNotificationCount }} | <b>In current
                                    page: {{ $startIndex . '-' . $endIndex }}</b>
                                {{--                                <a href="#" class="btn btn-xs btn-danger"><i class=" fa fa-trash"></i>Delete</a>--}}
                                {{--                                    </label>--}}
                                {{--                                </div>--}}
                                {{--                                <div class="table-search pull-right col-xs-7">--}}
                                {{--                                    <div class="form-group">--}}
                                {{--                                        <label class="col-xs-5 control-label text-right">Search <br>--}}
                                {{--                                            <a title="clear filter" class="clear-filter" href="#clear">[clear]</a>--}}
                                {{--                                        </label>--}}
                                {{--                                        <div class="col-xs-7 searchpan">--}}
                                {{--                                            <input class="form-control" id="filter" type="text">--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                            <table class="table table-bordered add-manage-table">
                                <thead>
                                <tr>
                                    {{--                                    <th data-type="numeric"></th>--}}
                                    <th class="col-sm-1">{{ __('titles.user') }}</th>
                                    <th class="col-sm-8">{{ __('titles.content') }}</th>
                                    {{--                                    <th>Price</th>--}}
                                    <th class="col-sm-3">{{ __('titles.option') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notificationList as $notification)
                                    <tr style={{ $notification->status == 0 ? 'background:#CECEF6;' : '' }}>
                                        <td class="col-sm-1">
                                            <a href="{{ route('users.show', $notification->user->id) }}">
                                                <img class="img-responsive"
                                                     src="{{ str_replace('public/', '', asset($notification->user->avatar)) }}"
                                                     alt="img">
                                            </a>
                                        </td>
                                        <td class="col-sm-9">
                                            <p>{!! $notification->content !!}</p>
                                            <p><strong> Created at: </strong>
                                                {{ $notification->created_at }} </p>
                                        </td>
                                        <td class="col-sm-2">
                                            <p>
                                                <a class="btn btn-info btn-xs change-status"
                                                   data-notiId="{{ $notification->id }}"
                                                   href="@if($notification->course_id) {{ '/courses/' . $notification->course_id . '/#li-comment-' . $notification->comment_id }} @elseif($notification->lecture_id) {{ '/courses/' . \App\Models\Lecture::findOrFail($notification->lecture_id)->course->id .'/lectures/' . $notification->lecture_id . '/#li-comment-' . $notification->comment_id }} @endif">
                                                    <i class="fa fa-share-square-o"></i>
                                                    Detail
                                                </a>
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $notificationList->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).on('ready', function () {
            $('.change-status').on('click', function (event) {
                event.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'notifications/' + $(this).data('notiid') + '/changeStatus',
                    success: function () {
                    }
                }, "json");
                window.location.replace($(this).attr('href'));
            })
        })
    </script>
@endsection
