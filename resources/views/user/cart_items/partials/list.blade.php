<div class="col-sm-9 page-content" id="cart">
    <div class="inner-box">
        <h2 class="title-2"><i class="fa fa-shopping-cart"></i>&ensp;&ensp; {{ __('titles.my_cart') }} <span
                    class="badge"></span></h2>
        @if($courseRelationsInCart->isEmpty())
            <image src="/assets/img/empty_cart.png" alt="Empty cart"
                   style="display: block;margin-left: auto;margin-right: auto;width: 50%;"></image><br>
            <h4 class="text-center"> {{ __('messages.your_cart_is_empty_keep_shopping') }} </h4><br>
            <a class="btn btn-common btn-search btn-block" href="{{ route('home') }}"
               style="width: max-content;margin: 0 auto" ;><strong>{{ __('titles.keep_shopping') }}</strong></a>
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
                <table class="table table-striped table-bordered add-manage-table" id="in-cart-item-table">
                    <thead>
                    <tr>
                        <th data-type="numeric"></th>
                        <th>{{ __('titles.image') }}</th>
                        <th>{{ __('titles.course_detail') }}</th>
                        <th>{{ __('titles.price') }}</th>
                        <th>{{ __('titles.option') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courseRelationsInCart as $courseRelation)
                        @if($courseRelation->cart_item_type === \App\Models\CartItem::IN_CART_TYPE)
                            <tr id="cart-item-{{$courseRelation->id}}">
                                <td class="add-img-selector" id="checkbox-{{$courseRelation->id}}">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                        </label>
                                    </div>
                                </td>
                                <td class="add-img-td">
                                    <a href="{{ route('courses.show', $courseRelation->course->id) }}">
                                        <img class="img-responsive"
                                             src="{{ str_replace('public/', '', asset($courseRelation->course->course_avatar)) }}"
                                             alt="img">
                                    </a>
                                </td>
                                <td class="ads-details-td">
                                    <h4>
                                        <a href="{{ route('courses.show', $courseRelation->course->id) }}">{{ $courseRelation->course->title }}</a>
                                    </h4>
                                    <p><strong> {{ __('titles.instructor') }} </strong>:
                                        <a href="{{ route('users.show', $courseRelation->course->user->id) }}">{{ $courseRelation->course->user->name }}</a>
                                    </p>
                                    <p>
                                        <strong> {{ __('titles.seller') }} </strong>: {{ $courseRelation->course->seller }}
                                        <strong>{{ __('titles.schedule') }}
                                            : </strong> {{ $courseRelation->course->lecture_numbers . ' ' . __('titles.lectures') . ' ' . __('titles.in') . ' ' . $courseRelation->course->duration . ' ' . __('titles.minutes') }}
                                    </p>
                                </td>
                                <td class="price-td">
                                    <strong>
                                        @if(isset($courseRelation->course->promotion_price))
                                            <p><b style="color:red">{{ $courseRelation->course->promotion_price }}
                                                    $ </b><br><strike> {{ $courseRelation->course->origin_price }}
                                                    $</strike></p>
                                        @else
                                            <b>{{ $courseRelation->course->origin_price }}$</b>
                                        @endif
                                    </strong>
                                </td>
                                <td class="action-td">
                                    <p><a class="btn btn-danger btn-xs remove" data-id="{{ $courseRelation->id }}"> <i
                                                    class="fa fa-trash"></i> {{ __('titles.remove') }} </a></p>
                                    <p><a class="btn btn-info btn-xs save-for-later" data-id="{{ $courseRelation->id }}"
                                          id="save-for-later-{{$courseRelation->id}}"> <i
                                                    class="fa fa-share-square-o"></i> {{ __('titles.save_for_later') }}
                                        </a>
                                    </p>
                                    <p><a class="btn btn-xs move-to-wishlist" style="background-color:#3498db"
                                          data-id="{{ $courseRelation->id }}"
                                          id="move-to-wishlist-{{$courseRelation->id}}"> <i
                                                    class="fa fa-chevron-circle-down"></i> {{ __('titles.move_to_wishlist') }}
                                        </a></p>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                <div class="col-sm-3">
                    <h3> {{ __('titles.total') }}:</h3>
                    @if($totalOriginPriceInCart !== $totalPromotionPriceInCart)
                        <h2 style="color:red"> {{ $totalPromotionPriceInCart }}$ </h2>
                        <h3><strike> {{ $totalOriginPriceInCart }}$ </strike></h3>
                        <h4> @if($totalOriginPriceInCart !== 0) {{ number_format((float)(1 - $totalPromotionPriceInCart/$totalOriginPriceInCart)*100, 2, '.', '') }} @else
                                0 @endif % {{ __('titles.off') }}</h4>
                    @else
                        <h3>{{ $totalOriginPriceInCart }}$</h3>
                    @endif
                </div>
                <div class="col-sm-5">
                    <div class="col-xs-9 searchpan">
                        <input class="form-control" id="filter" type="text"
                               placeholder="{{ __('titles.apply_coupon_code') }}">
                    </div>
                    <button type="submit" class="btn btn-xs pull-right" style="background-color:#3498db">Apply</button>
                    <br><br>
                    <p><i class="fa fa-check-circle"></i> 1811CYBERMONDAYEXTENSION is applied </p>
                </div>
                <div class="col-sm-4">
                    <a href="{{ route('cart_items.checkout.get') }}">
                        <button class="col-sm-9 btn"
                                style="float:right; background-color:#3498db"> {{ __('titles.checkout') }} </button>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="col-sm-9 page-content" id="saved-for-later">
    <div class="inner-box">
        <h2 class="title-2"><i class="fa fa-shopping-cart"></i>&ensp;&ensp; {{ __('titles.saved_for_later') }} <span
                    class="badge"></span></h2>
        @if($courseRelationsInLater->isEmpty())
            <h4 class="text-center"> {{ __('messages.have_not_saved_any_courses_for_later') }} </h4><br>
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
                <table class="table table-striped table-bordered add-manage-table" id="save-for-later-item-table">
                    <thead>
                    <tr>
                        <th data-type="numeric"></th>
                        <th>{{ __('titles.image') }}</th>
                        <th>{{ __('titles.course_detail') }}</th>
                        <th>{{ __('titles.price') }}</th>
                        <th>{{ __('titles.option') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courseRelationsInLater as $courseRelation)
                        @if($courseRelation->cart_item_type === \App\Models\CartItem::IN_LATER_TYPE)
                            <tr id="cart-item-{{$courseRelation->id}}">
                                <td class="add-img-selector">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                        </label>
                                    </div>
                                </td>
                                <td class="add-img-td">
                                    <a href="{{ route('courses.show', $courseRelation->course->id) }}">
                                        <img class="img-responsive"
                                             src="{{ str_replace('public/', '', asset($courseRelation->course->course_avatar)) }}"
                                             alt="img">
                                    </a>
                                </td>
                                <td class="ads-details-td">
                                    <h4>
                                        <a href="{{ route('courses.show', $courseRelation->course->id) }}">{{ $courseRelation->course->title }}</a>
                                    </h4>
                                    <p><strong> {{ __('titles.instructor') }} </strong>:
                                        <a href="{{ route('users.show', $courseRelation->course->user->id) }}">{{ $courseRelation->course->user->name }}</a>
                                    </p>
                                    <p><strong> {{ __('titles.views') }} </strong>: {{ $courseRelation->course->views }}
                                        <strong>{{ __('titles.schedule') }}
                                            : </strong> {{ $courseRelation->course->lecture_numbers . ' ' . __('titles.lectures') . ' ' . __('titles.in') . ' ' . $courseRelation->course->duration . __('titles.hours') }}
                                    </p>
                                </td>
                                <td class="price-td">
                                    <strong>
                                        @if(isset($courseRelation->course->promotion_price))
                                            <p><b style="color:red">{{ $courseRelation->course->promotion_price }}
                                                    $ </b><br><strike> {{ $courseRelation->course->origin_price }}
                                                    $</strike></p>
                                        @else
                                            <b>{{ $courseRelation->course->origin_price }}$</b>
                                        @endif
                                    </strong>
                                </td>
                                <td class="action-td" id="save-for-later-option">
                                    <p><a class="btn btn-danger btn-xs remove" data-id="{{ $courseRelation->id }}"> <i
                                                    class=" fa fa-trash"></i> {{ __('titles.remove') }} </a></p>
                                    <p><a class="btn btn-xs move-to-cart" style="background-color:#3498db"
                                          data-id="{{ $courseRelation->id }}"
                                          id="move-to-cart-{{ $courseRelation->id }}"> <i
                                                    class="fa fa-chevron-circle-down"></i> {{ __('titles.move_to_cart') }}
                                        </a></p>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<div class="col-sm-9 page-content" id="wishlist">
    <div class="inner-box">
        <h2 class="title-2"><i class="fa fa-shopping-cart"></i>&ensp;&ensp; {{ __('titles.wishlist') }} <span
                    class="badge"></span></h2>
        @if($courseRelationsInWishlist->isEmpty())
            <h4 class="text-center"> {{ __('messages.haven_not_added_any_courses_to_your_wishlist') }} </h4><br>
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
                <table class="table table-striped table-bordered add-manage-table" id="move-to-wishlist-item-table">
                    <thead>
                    <tr>
                        <th data-type="numeric"></th>
                        <th>{{ __('titles.image') }}</th>
                        <th>{{ __('titles.course_detail') }}</th>
                        <th>{{ __('titles.price') }}</th>
                        <th>{{ __('titles.option') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courseRelationsInWishlist as $courseRelation)
                        @if($courseRelation->cart_item_type === \App\Models\CartItem::IN_WISHLIST_TYPE)
                            <tr id="cart-item-{{$courseRelation->id}}">
                                <td class="add-img-selector">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                        </label>
                                    </div>
                                </td>
                                <td class="add-img-td">
                                    <a href="{{ route('courses.show', $courseRelation->course->id) }}">
                                        <img class="img-responsive"
                                             src="{{ str_replace('public/', '', asset($courseRelation->course->course_avatar)) }}"
                                             alt="img">
                                    </a>
                                </td>
                                <td class="ads-details-td">
                                    <h4>
                                        <a href="{{ route('courses.show', $courseRelation->course->id) }}">{{ $courseRelation->course->title }}</a>
                                    </h4>
                                    <p><strong> {{ __('titles.instructor') }} </strong>:
                                        <a href="{{ route('users.show', $courseRelation->course->user->id) }}">{{ $courseRelation->course->user->name }}</a>
                                    </p>
                                    <p><strong> {{ __('titles.views') }} </strong>: {{ $courseRelation->course->views }}
                                        <strong>{{ __('titles.schedule') }}
                                            : </strong> {{ $courseRelation->course->lecture_numbers . ' ' . __('titles.lectures') . ' ' . __('titles.in') . ' ' . $courseRelation->course->duration . __('titles.hours') }}
                                    </p>
                                </td>
                                <td class="price-td">
                                    <strong>
                                        @if(isset($courseRelation->course->promotion_price))
                                            <p><b style="color:red">{{ $courseRelation->course->promotion_price }}
                                                    $ </b><br><strike> {{ $courseRelation->course->origin_price }}
                                                    $</strike></p>
                                        @else
                                            <b>{{ $courseRelation->course->origin_price }}$</b>
                                        @endif
                                    </strong>
                                </td>
                                <td class="action-td">
                                    <p><a class="btn btn-danger btn-xs remove" data-id="{{ $courseRelation->id }}"> <i
                                                    class=" fa fa-trash"></i> {{ __('titles.remove') }} </a></p>
                                    <p><a class="btn btn-xs move-to-cart" style="background-color:#3498db"
                                          data-id="{{ $courseRelation->id }}"
                                          id="move-to-cart-{{ $courseRelation->id }}"> <i
                                                    class="fa fa-chevron-circle-down"></i> {{ __('titles.move_to_cart') }}
                                        </a></p>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>