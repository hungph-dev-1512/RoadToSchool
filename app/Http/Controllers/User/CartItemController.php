<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\CartItem;
use App\Models\CourseUser;
use App\Models\BillCourse;
use App\Constants\CreateCartItemStatus;
use Auth;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * The user model instance.
     */
    protected $modelCartItem;
    protected $modelBill;
    protected $modelCourseUser;
    protected $modelBillCourse;

    /**
     * Create a new controller instance.
     *
     * @param User $users
     * @return void
     */
    public function __construct(CartItem $cartItem, Bill $bill, CourseUser $courseUser, BillCourse $billCourse)
    {
        $this->modelCartItem = $cartItem;
        $this->modelBill = $bill;
        $this->modelCourseUser = $courseUser;
        $this->modelBillCourse = $billCourse;
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

    public function changeStatus(Request $requestAjax, $action)
    {
        $result = $this->modelCartItem->changeStatusCartItem($requestAjax->cartItemId, $action);

        return response()->json($result);
    }

    public function createNewItem(Request $requestAjax)
    {
        $billIds = $this->modelBill->where('user_id', Auth::user()->id)->select('id')->get();
        $courseIds = $this->modelBillCourse->whereIn('bill_id', $billIds)->pluck('course_id')->toArray();

        if ($this->modelCartItem->where('course_id', $requestAjax->courseId)->where('user_id', Auth::user()->id)->first()) {
            $result = CreateCartItemStatus::CART_ITEM_ALREADY;
        } else if ($this->modelCourseUser->where('course_id', $requestAjax->courseId)->where('user_id', Auth::user()->id)->first()) {
            $result = CreateCartItemStatus::MY_COURSE_ALREADY;
        } else if (in_array($requestAjax->courseId, $courseIds)) {
            $result = CreateCartItemStatus::MY_BILL_ALREADY;
        } else {
            $result = $this->modelCartItem->createNewItem($requestAjax->courseId, $requestAjax->cartItemType);
        }

        return response()->json($result);
    }
}
