<div class="col-sm-9 page-content" id="cart">
    <div class="inner-box">
        <h2 class="title-2"><i class="fa fa-shopping-cart"></i>&ensp;&ensp; {{ __('titles.my_cart') }} <span class="badge"></span></h2>
        <div class="table-responsive">
            <div class="table-action">
                <div class="checkbox">
                    <label for="checkAll">
                    <input id="checkAll" type="checkbox">
                    Select: All | <a href="#" class="btn btn-xs btn-danger"><i class=" fa fa-trash"></i>Delete</a>
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
                    @foreach($courseRelations as $courseRelatation)
                        @if($courseRelatation->cart_item_type === \App\Models\CartItem::IN_CART_TYPE)
                            <tr id="cart-item-{{$courseRelatation->id}}">
                                <td class="add-img-selector" id="checkbox-{{$courseRelatation->id}}">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                        </label>
                                    </div>
                                </td>
                                <td class="add-img-td">
                                    <a href="ads-details.html">
                                    <img class="img-responsive" src="{{ asset($courseRelatation->course->course_avatar) }}" alt="img">
                                    </a>
                                </td>
                                <td class="ads-details-td">
                                    <h4><a href="ads-details.html">{{ $courseRelatation->course->title }}</a></h4>
                                    <p> <strong> {{ __('titles.instructor') }} </strong>:
                                    <a href="{{ route('users.show', $courseRelatation->course->user->id) }}">{{ $courseRelatation->course->user->name }}</a>
                                    </p>
                                    <p> <strong> {{ __('titles.views') }} </strong>: {{ $courseRelatation->course->views }} <strong>{{ __('titles.schedule') }} : </strong> {{ $courseRelatation->course->lecture_numbers . ' ' . __('titles.lectures') . ' ' . __('titles.in') . ' ' . $courseRelatation->course->duration . __('titles.hours') }} </p>
                                </td>
                                <td class="price-td">
                                    <strong>
                                        @if(isset($courseRelatation->course->promotion_price))
                                            <p><b style="color:red">{{ $courseRelatation->course->promotion_price }}$ </b><br><strike> {{ $courseRelatation->course->origin_price }}$</strike></p>
                                        @else
                                            <b>{{ $courseRelatation->course->origin_price }}$</b>
                                        @endif
                                    </strong>
                                </td>
                                <td class="action-td">
                                    <p><a class="btn btn-danger btn-xs remove" data-id="{{ $courseRelatation->id }}"> <i class="fa fa-trash"></i> {{ __('titles.remove') }} </a></p>
                                    <p><a class="btn btn-info btn-xs save-for-later" data-id="{{ $courseRelatation->id }}" id="save-for-later-{{$courseRelatation->id}}"> <i class="fa fa-share-square-o"></i> {{ __('titles.save_for_later') }} </a></p>
                                    <p><a class="btn btn-xs move-to-wishlist" style="background-color:#3498db" data-id="{{ $courseRelatation->id }}" id="move-to-wishlist-{{$courseRelatation->id}}"> <i class="fa fa-chevron-circle-down"></i> {{ __('titles.move_to_wishlist') }} </a></p>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="col-sm-3">
                <h3> {{ __('titles.total') }}:</h3>
                <h2 style="color:red"> {{ $totalPromotionPriceInCart }}$ </h2>
                <h3><strike> {{ $totalOriginPriceInCart }}$ </strike></h3>
            <h4> {{ number_format((float)(1 - $totalPromotionPriceInCart/$totalOriginPriceInCart)*100, 2, '.', '') }} % {{ __('titles.off') }}</h4>
            </div>
            <div class="col-sm-5">
                <div class="col-xs-9 searchpan">
                    <input class="form-control" id="filter" type="text" placeholder="{{ __('titles.apply_coupon_code') }}">
                </div>
                <button type="submit" class="btn btn-xs pull-right" style="background-color:#3498db">Apply</button>
                <br><br>
                <p><i class="fa fa-check-circle"></i> 1811CYBERMONDAYEXTENSION is applied </p>
            </div>
            <div class="col-sm-4">
                <a href="{{ route('cart_items.checkout.get') }}"><button class="col-sm-9 btn" style="float:right; background-color:#3498db"> {{ __('titles.checkout') }} </button> </a> 
            </div>
        </div>
    </div>
</div>

<div class="col-sm-9 page-content" id="saved-for-later">
    <div class="inner-box">
        <h2 class="title-2"><i class="fa fa-shopping-cart"></i>&ensp;&ensp; {{ __('titles.saved_for_later') }} <span class="badge"></span></h2>
        <div class="table-responsive">
            <div class="table-action">
                <div class="checkbox">
                    <label for="checkAll">
                    <input id="checkAll" type="checkbox">
                    Select: All | <a href="#" class="btn btn-xs btn-danger"><i class=" fa fa-trash"></i>Delete</a>
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
                    @foreach($courseRelations as $courseRelatation)
                        @if($courseRelatation->cart_item_type === \App\Models\CartItem::IN_LATER_TYPE)
                            <tr id="cart-item-{{$courseRelatation->id}}">
                                <td class="add-img-selector">
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox">
                                        </label>
                                    </div>
                                </td>
                                <td class="add-img-td">
                                    <a href="ads-details.html">
                                    <img class="img-responsive" src="{{ asset($courseRelatation->course->course_avatar) }}" alt="img">
                                    </a>
                                </td>
                                <td class="ads-details-td">
                                    <h4><a href="ads-details.html">{{ $courseRelatation->course->title }}</a></h4>
                                    <p> <strong> {{ __('titles.instructor') }} </strong>:
                                    <a href="{{ route('users.show', $courseRelatation->course->user->id) }}">{{ $courseRelatation->course->user->name }}</a>
                                    </p>
                                <p> <strong> {{ __('titles.views') }} </strong>: {{ $courseRelatation->course->views }} <strong>{{ __('titles.schedule') }} : </strong> {{ $courseRelatation->course->lecture_numbers . ' ' . __('titles.lectures') . ' ' . __('titles.in') . ' ' . $courseRelatation->course->duration . __('titles.hours') }} </p>
                                </td>
                                <td class="price-td">
                                    <strong>
                                        @if(isset($courseRelatation->course->promotion_price))
                                            <p><b style="color:red">{{ $courseRelatation->course->promotion_price }}$ </b><br><strike> {{ $courseRelatation->course->origin_price }} $</strike></p>
                                        @else
                                            <b>{{ $courseRelatation->course->origin_price }}$</b>
                                        @endif
                                    </strong>
                                </td>
                                <td class="action-td" id="save-for-later-option">
                                    <p><a class="btn btn-danger btn-xs remove" data-id="{{ $courseRelatation->id }}"> <i class=" fa fa-trash"></i> {{ __('titles.remove') }} </a></p>
                                <p><a class="btn btn-xs move-to-cart" style="background-color:#3498db" data-id="{{ $courseRelatation->id }}" id="move-to-cart-{{ $courseRelatation->id }}"> <i class="fa fa-chevron-circle-down"></i> {{ __('titles.move_to_cart') }}</a></p>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-sm-9 page-content" id="wishlist">
    <div class="inner-box">
        <h2 class="title-2"><i class="fa fa-shopping-cart"></i>&ensp;&ensp; {{ __('titles.wishlist') }} <span class="badge"></span></h2>
        <div class="table-responsive">
            <div class="table-action">
                <div class="checkbox">
                    <label for="checkAll">
                    <input id="checkAll" type="checkbox">
                    Select: All | <a href="#" class="btn btn-xs btn-danger"><i class=" fa fa-trash"></i>Delete</a>
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
                    @foreach($courseRelations as $courseRelatation)
                        @if($courseRelatation->cart_item_type === \App\Models\CartItem::IN_WISHLIST_TYPE)
                            <tr id="cart-item-{{$courseRelatation->id}}">
                                <td class="add-img-selector">
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox">
                                        </label>
                                    </div>
                                </td>
                                <td class="add-img-td">
                                    <a href="ads-details.html">
                                    <img class="img-responsive" src="{{ asset($courseRelatation->course->course_avatar) }}" alt="img">
                                    </a>
                                </td>
                                <td class="ads-details-td">
                                    <h4><a href="ads-details.html">{{ $courseRelatation->course->title }}</a></h4>
                                    <p> <strong> {{ __('titles.instructor') }} </strong>:
                                    <a href="{{ route('users.show', $courseRelatation->course->user->id) }}">{{ $courseRelatation->course->user->name }}</a>
                                    </p>
                                <p> <strong> {{ __('titles.views') }} </strong>: {{ $courseRelatation->course->views }} <strong>{{ __('titles.schedule') }} : </strong> {{ $courseRelatation->course->lecture_numbers . ' ' . __('titles.lectures') . ' ' . __('titles.in') . ' ' . $courseRelatation->course->duration . __('titles.hours') }} </p>
                                </td>
                                <td class="price-td">
                                    <strong>
                                        @if(isset($courseRelatation->course->promotion_price))
                                            <p><b style="color:red">{{ $courseRelatation->course->promotion_price }}$ </b><br><strike> {{ $courseRelatation->course->origin_price }} $</strike></p>
                                        @else
                                            <b>{{ $courseRelatation->course->origin_price }}$</b>
                                        @endif
                                    </strong>
                                </td>
                                <td class="action-td">
                                    <p><a class="btn btn-danger btn-xs remove" data-id="{{ $courseRelatation->id }}"> <i class=" fa fa-trash"></i> {{ __('titles.remove') }} </a></p>
                                    <p><a class="btn btn-xs move-to-cart" style="background-color:#3498db" data-id="{{ $courseRelatation->id }}" id="move-to-cart-{{ $courseRelatation->id }}"> <i class="fa fa-chevron-circle-down"></i> {{ __('titles.move_to_cart') }}</a></p>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>