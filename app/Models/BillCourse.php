<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BillCourse extends Model
{
    protected $table = 'bill_course';
    protected $fillable = [
        'bill_id',
        'course_id',
        'price'
    ];

    public static function createNewBillCourse($createdBillId, $dataBillCourseIds, $dataPrice)
    {
        DB::beginTransaction();
        foreach ($dataBillCourseIds as $key => $value) {
            $data['bill_id'] = $createdBillId;
            $data['course_id'] = $value;
            $data['price'] = $dataPrice[$key];

            $result =
                BillCourse::create($data);;

            if (!$result) {
                return false;
            }
        }
        DB::commit();

        return true;
    }
}
