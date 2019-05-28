<div class="header">
    <nav class="navbar navbar-default main-navigation" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="/"><img src="/assets/img/logo.png" alt=""></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right" id="top-nav-area">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <input type="hidden" value="{{ \Auth::user()->id }}" id="current-user">
                        {{--Cart--}}
                        <li class="dropdown">
                            @php
                                $cartItemsQuery = \App\Models\CartItem::where('user_id', Auth::user()->id)->where('cart_item_type', \App\Models\CartItem::IN_CART_TYPE);
                                $cartItems = $cartItemsQuery->get();
                                $cartItemsCount =count($cartItems);
                                $totalOriginPrice = 0;
                                $totalPromotionPrice = 0;
                                foreach($cartItems as $cartItem) {
                                $totalOriginPrice += $cartItem->course->origin_price;
                                if(0 != $cartItem->course->promotion_price) {
                                $totalPromotionPrice += $cartItem->course->promotion_price;
                                } else {
                                $totalPromotionPrice += $cartItem->course->origin_price;
                                }
                                }
                            @endphp
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-shopping-cart"></i> {{ __('titles.cart') }} <span
                                        class="badge"> {{ $cartItemsCount }} </span></a>
                            <ul class="dropdown-menu dropdown-cart" role="menu">
                                @if($cartItems->isEmpty())
                                    <li class="text-center">
                                        <h4> {{ __('messages.your_cart_is_empty') }}</h4>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a class="text-center" href="{{ route('home') }}">
                                            <h4>{{ __('titles.keep_shopping') }}</h4>
                                        </a>
                                    </li>
                                @else
                                    @foreach($cartItems as $cartItem)
                                        <li class="cart-item-detail" style="cursor: pointer;"
                                            data-id="{{ $cartItem->course->id }}">
                                            {{--<a href="{{ route('courses.show', $cartItem->course->id) }}">--}}
                                            <span class="item">
                                                <span class="item-left">
                                                   <img src="{{ str_replace('public/', '', asset($cartItem->course->course_avatar)) }}"
                                                        alt=""/>
                                                   <span class="item-info">
                                                      <span><strong> {{ (strlen($cartItem->course->title) >= 19) ? substr($cartItem->course->title, 0, 15) . '...' : $cartItem->course->title }}  </strong></span>
                                                      <span>
                                                         @if(isset($cartItem->course->promotion_price))
                                                              <p><b style="color:red">{{ $cartItem->course->promotion_price }}$ </b><strike> {{ $cartItem->course->origin_price }}$</strike></p>
                                                          @else
                                                              <b>{{ $cartItem->course->origin_price }}$</b>
                                                          @endif
                                                      </span>
                                                   </span>
                                                </span>
                                                </span>
                                            {{--</a>--}}
                                        </li>
                                    @endforeach
                                    <li class="divider"></li>
                                    <li>
                                        <h5 class="text-center">
                                            <p>
                                                @if(0 != $totalPromotionPrice)
                                                    <strong>{{ __('titles.total') }}</strong>: <b
                                                            style="color:red">{{ $totalPromotionPrice }}$ </b>
                                                    <strike> {{ $totalOriginPrice }} $</strike>
                                            @else
                                                <h4>{{ __('titles.total') }}</h4>
                                                : <b>{{ $totalOriginPrice }}$</b>
                                                @endif
                                                </p>
                                        </h5>
                                        <a class="text-center" href="{{ route('cart_items.index') }}">
                                            <h4>{{ __('titles.checkout_cart') }}</h4>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        {{-- Notification --}}
                        @php
                            $notificationsList = \App\Models\Notification::where('user_id', \Auth::user()->id)->orderBy('created_at', 'desc');
                            $notifications = $notificationsList->limit(8)->get()
                        @endphp
{{--                    {{ dd(\Session::all()) }}--}}
                        <li class="dropdown" id="notification-area">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-shopping-cart"></i> {{ __('titles.u_notification') }} <span
                                        class="badge"
                                        id="notification-count"> {{ $notificationsList->where('status', 0)->count() }} </span></a>
                            <ul class="dropdown-menu dropdown-cart" id="notification-list" role="menu"
                                style="width: 350px">
                                @if($notifications->isEmpty())
                                    <li class="text-center" id="none-dock">
                                        <h4> {{ __('messages.you_are_no_notification') }}</h4>
                                    </li>
                                @else
                                    @foreach($notifications as $notification)
                                        @if($notification->type == 1 || $notification->type == 2)
                                            <li class="notification-detail" data-id="{{ $notification->id }}"
                                                data-status="{{ $notification->status }}"
                                                style="cursor: pointer; {{ $notification->status ? '' : 'background: #CECEF6' }}"
                                                data-type="{{ $notification->type }}"
                                                data-course="{{ $notification->course_id }}"
                                                data-comment="{{ $notification->comment_id }}"
                                                data-parent="{{ $notification->course_id ? \App\Models\Comment::findOrFail($notification->comment_id)->parent_comment : \App\Models\LectureComment::findOrFail($notification->comment_id)->parent_comment }}"
                                                data-lectureCommentCourseId="{{ $notification->course_id ? 'undefined' : \App\Models\Lecture::findOrFail($notification->lecture_id)->course->id }}"
                                                data-lectureCommentLectureId="{{ $notification->course_id ? 'undefined' : $notification->lecture_id }}">
                                                <span class="item">
                                                    <span class="item-left">
                                                        @if($notification->type == \App\Models\Notification::WELCOME)
                                                            <img src="/assets/img/logo-short.png"
                                                                 style="height: 45px; width: 45px"
                                                                 alt=""/>
                                                        @elseif($notification->type == \App\Models\Notification::COMMENT || $notification->type == \App\Models\Notification::LECTURE_COMMENT)
                                                            <img src="{{ $notification->type == \App\Models\Notification::COMMENT ? str_replace('public/', '', asset(\App\Models\Comment::findOrFail($notification->comment_id)->user->avatar)) : str_replace('public/', '', asset(\App\Models\LectureComment::findOrFail($notification->comment_id)->user->avatar)) }}"
                                                                 style="height: 45px; width: 45px" alt=""/>
                                                        @endif
                                                       <span class="item-info">
                                                          <span> {!! (strlen($notification->content) >= 24) ? substr($notification->content, 0, 30) . '...' : $notification->content !!} </span>
                                                       <span class="diff-time" id="diff-time-{{ $notification->id }}"
                                                             data-time="{{ strtotime($notification->created_at) }}">
                                                             @php
                                                                 $diffTime = \Carbon\Carbon::parse($notification->created_at)->diffForHumans();
                                                             @endphp
                                                           {{ $diffTime }}
                                                          </span>
                                                       </span>
                                                    </span>
                                                </span>
                                            </li>
                                        @elseif($notification->type == 0)
                                            <li class="notification-detail"
                                                style="cursor: pointer; {{ $notification->status ? '' : 'background: #CECEF6' }}">
                                                <span class="item">
                                                    <span class="item-left">
                                                            <img src="/assets/img/logo-short.png"
                                                                 style="height: 45px; width: 45px"
                                                                 alt=""/>
                                                       <span class="item-info">
                                                          <span> {!! (strlen($notification->content) >= 24) ? substr($notification->content, 0, 30) . '...' : $notification->content !!} </span>
                                                       <span class="diff-time" id="diff-time-{{ $notification->id }}"
                                                             data-time="{{ strtotime($notification->created_at) }}">
                                                             @php
                                                                 $diffTime = \Carbon\Carbon::parse($notification->created_at)->diffForHumans();
                                                             @endphp
                                                           {{ $diffTime }}
                                                          </span>
                                                       </span>
                                                    </span>
                                                </span>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li class="divider"></li>
                                    <li class="text-center">
                                        <a href="{{ route('notifications.index') }}">
                                            <h4> {{ __('titles.see_all_noti') }} </h4></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        {{-- Language--}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('titles.language') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{!! route('user.change-language', ['en']) !!}"
                                   style="display: block;">
                                    {{ __('titles.english') }}
                                </a>
                                <a class="dropdown-item" href="{!! route('user.change-language', ['vi']) !!}"
                                   style="display: block;">
                                    {{ __('titles.vietnamese') }}
                                </a>
                            </div>
                        </li>
                        {{--Account--}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}"
                                   style="display: block;">
                                    {{ __('titles.my_profile') }}
                                </a>
                                @if(Auth::user()->is_admin)
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}"
                                       style="display: block;">
                                        {{ __('titles.r2s_admin') }}
                                    </a>
                                @elseif(Auth::user()->role == 1)
                                    <a class="dropdown-item" href="{{ route('instructor.dashboard') }}"
                                       style="display: block;">
                                        {{ __('titles.r2s_instructor') }}
                                    </a>
                                @elseif(Auth::user()->role == 2)
                                    <a class="dropdown-item" href="{{ route('courses.my_course', Auth::user()->id) }}"
                                       style="display: block;">
                                        {{ __('titles.my_course') }}
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                {{ Form::open(['method' => 'post', 'url' => 'logout', 'id' => 'logout-form', 'style' => 'display: none;']) }}
                                {{ Form::close() }}
                            </div>
                        </li>
                    @endguest
                    {{--
                    <li class="postadd">
                       <a class="btn btn-danger btn-post" href="post-ads.html"><span class="fa fa-plus-circle"></span> Post an Ad</a>
                    </li>
                    --}}
                </ul>
            </div>
        </div>
    </nav>
    <div class="navmenu navmenu-default navmenu-fixed-left offcanvas">
        <div class="close" data-toggle="offcanvas" data-target=".navmenu">
            <i class="fa fa-close"></i>
        </div>
        <h3 class="title-menu"> {{ __('titles.all_pages') }} </h3>
        <ul class="nav navmenu-nav">
            <li><a href=""> {{ __('titles.home') }} </a></li>
            <li><a href=""> {{ __('titles.register') }} </a></li>
            <li><a href=""> {{ __('titles.login') }} </a></li>
        </ul>
    </div>
</div>
{{--<div class="tbtn wow pulse" id="menu" data-wow-iteration="infinite" data-wow-duration="500ms" data-toggle="offcanvas"--}}
{{--     data-target=".navmenu">--}}
{{--    <p><i class="fa fa-file-text-o"></i> {{ __('titles.all_pages') }} </p>--}}
{{--</div>--}}
</div>
</div>
</div>