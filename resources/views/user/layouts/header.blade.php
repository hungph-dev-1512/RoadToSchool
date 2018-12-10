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
                            <ul class="nav navbar-nav navbar-right">
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ __('titles.categories') }} 
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="">
                                            TODO1
                                        </a>
                                        <br>
                                        <a class="dropdown-item" href="">
                                            TODO2
                                        </a>
                                    </div>
                                </li>
                                
                                @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                @else
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
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-shopping-cart"></i> Cart <span class="badge"> {{ $cartItemsCount }} </span></a>
                                    <ul class="dropdown-menu dropdown-cart" role="menu">
                                        @foreach($cartItems as $cartItem)
                                            <li>
                                                <span class="item">
                                                <span class="item-left">
                                                    <img src="{{ asset($cartItem->course->course_avatar) }}" alt="" />
                                                    <span class="item-info">
                                                        <span><strong> {{$cartItem->course->title}} </strong></span>
                                                    <span> 
                                                        @if(isset($cartItem->course->promotion_price))
                                                            <p><b style="color:red">{{ $cartItem->course->promotion_price }}$ </b><strike> {{ $cartItem->course->origin_price }}$</strike></p>
                                                        @else
                                                            <b>{{ $cartItem->course->origin_price }}$</b>
                                                        @endif
                                                    </span>
                                                </span>
                                            </span>
                                            </li>
                                        @endforeach
                                        <li class="divider"></li>
                                        <li><h5 class="text-center">
                                            <p>
                                                @if(0 != $totalPromotionPrice)
                                                    <strong>{{ __('titles.total') }}</strong>: <b style="color:red">{{ $totalPromotionPrice }}$ </b><strike> {{ $totalOriginPrice }} $</strike>
                                                @else
                                                    <h4>{{ __('titles.total') }}</h4>: <b>{{ $totalOriginPrice }}$</b>
                                                @endif
                                            </p></h5><a class="text-center" href="{{ route('cart_items.index') }}"><h4>{{ __('titles.checkout_cart') }}</h4></a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">
                                            {{ __('titles.my_profile') }}
                                        </a>
                                        <br>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        {{ Form::open(['method' => 'post', 'url' => 'logout', 'id' => 'logout-form']) }}
                                        {{ Form::close() }}
                                    </div>
                                </li>
                                @endguest
                                {{-- <li class="postadd">
                                    <a class="btn btn-danger btn-post" href="post-ads.html"><span class="fa fa-plus-circle"></span> Post an Ad</a>
                                </li> --}}
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
            <div class="tbtn wow pulse" id="menu" data-wow-iteration="infinite" data-wow-duration="500ms" data-toggle="offcanvas" data-target=".navmenu">
                <p><i class="fa fa-file-text-o"></i> {{ __('titles.all_pages') }} </p>
            </div>
        </div>
    </div>
</div>
