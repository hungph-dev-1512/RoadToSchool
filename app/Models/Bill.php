<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

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
        if(\Auth::check()) {
            $data['user_id'] = Auth::user()->id;
        }

        $createBillResult = Bill::create($data);
        if(!$createBillResult) {
            return false;
        }
        $createdBillId = $createBillResult->id;
        $createBillCourseResult = BillCourse::createNewBillCourse($createdBillId, $data['course_id']);

        if(!$createBillCourseResult) {
            return false;
        }

        return $createBillResult;
    }
}
