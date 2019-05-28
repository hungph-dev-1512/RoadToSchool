<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Bill;
use Auth;

class BillController extends Controller
{
    /**
     * The user model instance.
     */
    protected $modelBill;
    protected $cartItem;

    /**
     * Create a new controller instance.
     *
     * @param User $users
     * @return void
     */
    public function __construct(Bill $bill, CartItem $cartItem)
    {
        $this->modelBill = $bill;
        $this->modelCartItem = $cartItem;
    }

    public function getCheckout()
    {
        $courseRelations = CartItem::where('user_id', Auth::user()->id)->where('cart_item_type', CartItem::IN_CART_TYPE)->get();
        if ($courseRelations->isEmpty()) {
            abort(404);  //404 page
        }
        $totalPriceInCart = $this->modelCartItem->getTotalOriginPriceFollowType(CartItem::IN_CART_TYPE);
        $totalOriginPriceInCart = $totalPriceInCart['origin_price'];
        $totalPromotionPriceInCart = $totalPriceInCart['promotion_price'];

        return view('user.cart_items.checkout', compact(
            'courseRelations',
            'totalOriginPriceInCart',
            'totalPromotionPriceInCart'
        ));
    }

    public function postCheckout(Request $request)
    {
        if (!$request->course_id) {
            abort(404);  //404 page
        }
        $data = $request->all();
        $result = $this->modelBill->addBill($data);

        CartItem::where('cart_item_type', CartItem::IN_CART_TYPE)->delete();
        if (!$result) {
            abort(404);  //404 page
        }

        return view('user.cart_items.checkout_success');
    }
}
