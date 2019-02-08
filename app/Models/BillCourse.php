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
    ];

    public static function createNewBillCourse($createdBillId, $dataBillCourseIds)
    {
        DB::beginTransaction();
        foreach ($dataBillCourseIds as $value) {
            $data['bill_id'] = $createdBillId;
            $data['course_id'] = $value;

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
