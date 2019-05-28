<div class="col-sm-3 page-sideabr">
    <aside>
        <div class="inner-box">
            <div class="user-panel-sidebar">
                <div class="collapse-box">
                    <h5 class="collapset-title no-border"> {{ __('titles.profile_info') }} <a aria-expanded="true"
                                                                                              class="pull-right"
                                                                                              data-toggle="collapse"
                                                                                              href="#myclassified"><i
                                    class="fa fa-angle-down"></i></a></h5>
                    <div aria-expanded="true" id="myclassified" class="panel-collapse collapse in">
                        <ul class="acc-list">
                            <li id="personal-page">
                                <a href="{{ route('users.show', Auth::user()->id) }}"><i
                                            class="fa fa-user"></i> {{ __('titles.personal_page') }} </a>
                            </li>
                            <li>
                                <a href="{{ route('notifications.index') }}"><i
                                            class="fa fa-bell"></i> {{ __('titles.notification') }} </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="collapse-box">
                    <h5 class="collapset-title"> {{ __('titles.course') }} <a aria-expanded="true" class="pull-right"
                                                                              data-toggle="collapse" href=""><i
                                    class="fa fa-angle-down"></i> </a></h5>
                    <div aria-expanded="true" id="myads" class="panel-collapse collapse in">
                        <ul class="acc-list">
                            <li>
                                <a href="{{ route('courses.my_course', \Auth::user()->id) }}"><i
                                            class="fa fa-book"></i>&ensp;&ensp; {{ __('titles.my_course') }}
                                    <span class="badge"></span></a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('users.notifications', $selectedUser->id) }}"><i class="fa fa-hourglass-o"></i>&ensp;&ensp; {{ __('titles.notification') }} <span class="badge"> {{ ($countUnreadNotifications != 0) ? $countUnreadNotifications : '' }} </span></a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="collapse-box">
                    <h5 class="collapset-title"> {{ __('titles.cart') }} <a aria-expanded="true" class="pull-right"
                                                                            data-toggle="collapse" href=""><i
                                    class="fa fa-angle-down"></i> </a></h5>
                    <div aria-expanded="true" id="myads" class="panel-collapse collapse in">
                        <ul class="acc-list">
                            <li id="my-cart">
                                <a href="{{ route('cart_items.index') }}"><i class="fa fa-shopping-cart"></i>&ensp;&ensp; {{ __('titles.my_cart') }}
                                    <span class="badge">{{ \App\Models\CartItem::where('user_id', \Auth::user()->id)->where('cart_item_type', 0)->get()->count() }}</span></a>
                            </li>
                            <li>
                                <a href="#saved-for-later"><i
                                            class="fa fa-star-o"></i>&ensp;&ensp; {{ __('titles.saved_for_later') }}
                                    <span class="badge">{{ \App\Models\CartItem::where('user_id', \Auth::user()->id)->where('cart_item_type', 1)->get()->count() }}</span></a>
                            </li>
                            <li>
                                <a href="#wishlist"><i
                                            class="fa fa-heart-o"></i>&ensp;&ensp; {{ __('titles.wishlist') }} <span
                                            class="badge">{{ \App\Models\CartItem::where('user_id', \Auth::user()->id)->where('cart_item_type', 2)->get()->count() }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="collapse-box">
                    <h5 class="collapset-title"> {{ __('titles.terminate_account') }} <a aria-expanded="true"
                                                                                         class="pull-right"
                                                                                         data-toggle="collapse"
                                                                                         href="#close"><i
                                    class="fa fa-angle-down"></i></a></h5>
                    <div aria-expanded="true" id="close" class="panel-collapse collapse in">
                        <ul class="acc-list">
                            <li>
                                <a href="account-close.html"><i
                                            class="fa fa-close"></i> {{ __('titles.close_account') }} </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="inner-box">
            <div class="widget-title">
                <h4>Advertisement</h4>
            </div>
            <img src="/assets/img/img1.jpg" alt="">
        </div>
        <div class="inner-box">
            <div class="widget-title">
                <h4>Advertisement</h4>
            </div>
            <img src="/assets/img/img1.jpg" alt="">
        </div>
    </aside>
</div>