@extends('user.layouts.default')

@section('title')
    {{ __('titles.course_list') }}
@endsection

@section('content')
    {{ Breadcrumbs::render('cart') }}<br>
    <div id="content">
        <div class="container">
            <div class="row">
                @include('user.partials.user_management_info')
                @include('user.cart_items.partials.list')
            </div>
        </div>
    </div>
    </div>
@endsection
@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#my-cart').addClass('active');

            $('.remove').on('click', function () {
                var cartItemId = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'cart_items/remove',
                    data: {
                        cartItemId: cartItemId,
                    },
                    success: function () {
                        // $('#cart-item-' + cartItemId).remove();
                        location.reload();
                    }
                }, "json")
            });

            $('.save-for-later').on('click', function () {
                var cartItemId = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'cart_items/save_for_later',
                    data: {
                        cartItemId: cartItemId,
                    },
                    success: function (data) {
                        location.reload();
                    }
                }, "json")
            });

            $('.move-to-wishlist').on('click', function () {
                var cartItemId = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'cart_items/move_to_wishlist',
                    data: {
                        cartItemId: cartItemId,
                    },
                    success: function (data) {
                        location.reload();
                        // var dataParsed = jQuery.parseJSON(data);
                        // var cartItem = dataParsed.cartItem;
                        // console.log(cartItem);
                        // var row = $('#cart-item-' + cartItem.id).closest('tr').html();
                        // $('#cart-item-' + cartItem.id).parent().remove();
                        // $('#move-to-wishlist-item-table tbody').append('<tr>'+row+'</tr>');
                        // $('#checkbox-' + cartItem.id).parent().attr('id', 'cart-item-' + cartItem.id);
                        // $('#save-for-later-' + cartItem.id).remove();
                        // $('#move-to-wishlist-' + cartItem.id).attr('id', 'move-to-cart-' + cartItem.id);
                        // $('#move-to-cart-' + cartItem.id).html('<i class="fa fa-chevron-circle-down"></i> Move to cart');
                    }
                }, "json")
            });

            $('.move-to-cart').on('click', function () {
                var cartItemId = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'cart_items/move_to_cart',
                    data: {
                        cartItemId: cartItemId,
                    },
                    success: function (data) {
                        location.reload();
                        // var dataParsed = jQuery.parseJSON(data);
                        // var cartItem = dataParsed.cartItem;
                        // var row = $('#cart-item-' + cartItem.id).closest('tr').html();
                        // $('#cart-item-' + cartItem.id).parent().remove();
                        // $('#in-cart-item-table tbody').append('<tr>'+row+'</tr>');
                        // $('#checkbox-' + cartItem.id).parent().attr('id', 'cart-item-' + cartItem.id);
                        // $('#move-to-cart-' + cartItem.id).attr('id', 'move-to-wishlist-' + cartItem.id);
                        // $('#move-to-wishlist-' + cartItem.id).html('<i class="fa fa-chevron-circle-down"></i> Move to wishlist');
                        // $('<p><a class="btn btn-info btn-xs save-for-later" data-id="' + cartItem.id + '" id="save-for-later-' + cartItem.id + '"> <i class="fa fa-share-square-o"></i> Save for later </a></p>').insertBefore('#move-to-wishlist-' + cartItem.id);
                    }
                }, "json")
            });
        });
    </script>
@endsection
