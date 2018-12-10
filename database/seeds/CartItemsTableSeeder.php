<?php

use Illuminate\Database\Seeder;
use App\Models\CartItem;

class CartItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('cart_items')->truncate();
        Schema::enableForeignKeyConstraints();

        CartItem::create([
            'cart_item_type' => CartItem::IN_CART_TYPE,
            'course_id' => '1',
            'user_id' => '1',
        ]);

        CartItem::create([
            'cart_item_type' => CartItem::IN_LATER_TYPE,
            'course_id' => '2',
            'user_id' => '1',
        ]);

        CartItem::create([
            'cart_item_type' => CartItem::IN_WISHLIST_TYPE,
            'course_id' => '3',
            'user_id' => '1',
        ]);
    }
}
