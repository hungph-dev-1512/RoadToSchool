<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\CartItem;
use Auth;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * The user model instance.
     */
    protected $modelCartItem;
    protected $modelBill;

    /**
     * Create a new controller instance.
     *
     * @param  User $users
     * @return void
     */
    public function __construct(CartItem $cartItem, Bill $bill)
    {
        $this->modelCartItem = $cartItem;
        $this->modelBill = $bill;
    }

    public function index()
    {
        $courseRelationsInCart = CartItem::where('user_id', Auth::user()->id)->where('cart_item_type', CartItem::IN_CART_TYPE)->get();
        $courseRelationsInLater = CartItem::where('user_id', Auth::user()->id)->where('cart_item_type', CartItem::IN_LATER_TYPE)->get();
        $courseRelationsInWishlist = CartItem::where('user_id', Auth::user()->id)->where('cart_item_type', CartItem::IN_WISHLIST_TYPE)->get();
        $totalPriceInCart = $this->modelCartItem->getTotalOriginPriceFollowType(CartItem::IN_CART_TYPE);
        $totalOriginPriceInCart = $totalPriceInCart['origin_price'];
        $totalPromotionPriceInCart = $totalPriceInCart['promotion_price'];

        return view('user.cart_items.index', compact(
            'courseRelationsInCart',
            'courseRelationsInLater',
            'courseRelationsInWishlist',
            'totalOriginPriceInCart',
            'totalPromotionPriceInCart'
        ));
    }

    public function getCheckout()
    {
        $courseRelations = CartItem::where('user_id', Auth::user()->id)->where('cart_item_type', CartItem::IN_CART_TYPE)->get();

        return view('user.cart_items.checkout', compact(
            'courseRelations'
        ));
    }

    public function postCheckout(Request $request)
    {
        $data = $request->all();
        $result = $this->modelBill->addBill($data);

        if ($result) {
            flash(__('messages.update_successfully'))->success();
        } else {
            flash(__('messages.update_failed'))->error();
        }

        return view('user.cart_items.checkout_success');
    }

    public function changeStatus(Request $requestAjax, $action)
    {
        $result = $this->modelCartItem->changeStatusCartItem($requestAjax->cartItemId, $action);

        return response()->json($result);
    }

    public function createNewItem(Request $requestAjax)
    {
        if ($this->modelCartItem->where('course_id', $requestAjax->courseId)->where('user_id', Auth::user()->id)->first()) {
            $result = false;
        } else {
            $result = $this->modelCartItem->createNewItem($requestAjax->courseId, $requestAjax->cartItemType);
        }

        return response()->json($result);
    }
}
