<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    const PAYMENT_BY_CARD = 1;
    const CASH_ON_DELIVERY = 2;
    public static $roles = [
        self::PAYMENT_BY_CARD => 'Payment via card',
        self::CASH_ON_DELIVERY => 'Cash on delivery (COD)',
    ];
    protected $table = 'bills';
    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'customer_note',
        'payment',
        'get_ads'
    ];

    public function addBill($data)
    {
        $data['payment'] = self::CASH_ON_DELIVERY;
        if (isset($data['get_ads'])) {
            $data['get_ads'] = true;
        } else {
            $data['get_ads'] = false;
        }

        return Bill::create($data);
    }
}
