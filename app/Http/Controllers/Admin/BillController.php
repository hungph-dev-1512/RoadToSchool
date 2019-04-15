<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bill;
use App\Models\BillCourse;
use App\Models\Course;
use App\Models\CourseUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * The user model instance.
     */
    protected $modelBill;
    protected $modelBillCourse;
    protected $modelCourse;
    protected $modelCourseUser;

    /**
     * Create a new controller instance.
     *
     * @param  User $users
     * @return void
     */
    public function __construct(Bill $bill, BillCourse $billCourse, Course $course, CourseUser $courseUser)
    {
        $this->modelBill = $bill;
        $this->modelBillCourse = $billCourse;
        $this->modelCourse = $course;
        $this->modelCourseUser = $courseUser;
    }

    public function index()
    {
        $billsList = Bill::all();

        return view('admin.bills.index', compact('billsList'));
    }

    public function create()
    {
        return view('admin.bills.create');
    }

    public function updateStatus(Request $requestAjax)
    {
        $result = Bill::find($requestAjax->billId)->update(['status' => $requestAjax->statusId]);
        $userId = Bill::find($requestAjax->billId)->user_id;
        $courseIdList = BillCourse::where('bill_id', $requestAjax->billId)->pluck('course_id');
        if($requestAjax->statusId == Bill::ACTIVATED && $userId) {
            foreach($courseIdList as $courseId) {
                $this->modelCourseUser->create(['user_id' => $userId, 'course_id' => $courseId]);

            }
        }

        return json_encode($courseIdList);
    }

    public function show($id)
    {
        $bill = Bill::findOrFail($id);
        $billCourses = $this->modelBillCourse->where('bill_id', $id)->get();

        return view('admin.bills.show', compact('bill', 'billCourses'));
    }
}
