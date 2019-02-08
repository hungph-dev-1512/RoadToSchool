<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    const IN_CART_TYPE = 0;
    const IN_LATER_TYPE = 1;
    const IN_WISHLIST_TYPE = 2;
    public static $cart_item_types = [
        self::IN_CART_TYPE => 'In cart',
        self::IN_LATER_TYPE => 'In later buy',
        self::IN_WISHLIST_TYPE => 'In wishlist',
    ];
    protected $table = 'cart_items';
    protected $fillable = [
        'cart_item_type',
        'course_id',
        'user_id',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function changeStatusCartItem($cartItemId, $action)
    {
        $selectedCartItem = CartItem::findOrFail($cartItemId);
        switch ($action) {
            case 'remove':
                {
                    return $selectedCartItem->delete();
                }
            case 'save_for_later':
                {
                    $result = $selectedCartItem->update([
                        'cart_item_type' => self::IN_LATER_TYPE,
                    ]);

                    if ($result) {
                        $data['cartItem'] = CartItem::findOrFail($cartItemId);

                        return json_encode($data);
                    }
                }
            case 'move_to_wishlist':
                {
                    $result = $selectedCartItem->update([
                        'cart_item_type' => self::IN_WISHLIST_TYPE,
                    ]);

                    if ($result) {
                        $data['cartItem'] = CartItem::findOrFail($cartItemId);

                        return json_encode($data);
                    }
                }
            case 'move_to_cart':
                {
                    $result = $selectedCartItem->update([
                        'cart_item_type' => self::IN_CART_TYPE,
                    ]);
                    $result = true;
                    if ($result) {
                        $data['cartItem'] = CartItem::findOrFail($cartItemId);

                        return json_encode($data);
                    }
                }
            default:
                {
                    return false;
                }
        }
    }

    public function getTotalOriginPriceFollowType($type)
    {
        $cartItemsQuery = CartItem::where('user_id', Auth::user()->id)->where('cart_item_type', $type);
        $result['origin_price'] = 0;
        $result['promotion_price'] = 0;
        foreach ($cartItemsQuery->get() as $cartItem) {
            $result['origin_price'] += $cartItem->course->origin_price;
            if ($cartItem->course->promotion_price != 0) {
                $result['promotion_price'] += $cartItem->course->promotion_price;
            } else {
                $result['promotion_price'] += $cartItem->course->origin_price;
            }
        }

        return $result;
    }

    public function createNewItem($requestCourseId, $requestCartItemType)
    {
        $dataId['course_id'] = $requestCourseId;
        $dataId['user_id'] = Auth::user()->id;
        if ($requestCartItemType === 'add-to-cart') {
            $dataId['cart_item_type'] = self::IN_CART_TYPE;
        } else if ($requestCartItemType === 'add-to-wishlist') {
            $dataId['cart_item_type'] = self::IN_WISHLIST_TYPE;
        }

        return CartItem::create($dataId);
    }
}
