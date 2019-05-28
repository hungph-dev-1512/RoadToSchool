<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bill;
use App\Models\BillCourse;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Process;
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
    protected $modelProcess;

    /**
     * Create a new controller instance.
     *
     * @param User $users
     * @return void
     */
    public function __construct(Bill $bill, BillCourse $billCourse, Course $course, CourseUser $courseUser, Process $process)
    {
        $this->modelBill = $bill;
        $this->modelBillCourse = $billCourse;
        $this->modelCourse = $course;
        $this->modelCourseUser = $courseUser;
        $this->modelProcess = $process;
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
        $currentStatusId = Bill::findOrFail($requestAjax->billId)->status;
        $courseIdList = BillCourse::where('bill_id', $requestAjax->billId)->pluck('course_id');
        Bill::find($requestAjax->billId)->update(['status' => $requestAjax->statusId]);
        $userId = Bill::find($requestAjax->billId)->user_id;

        // if course is already activated
        if ($currentStatusId == Bill::ACTIVATED) {
            foreach ($courseIdList as $courseId) {
                $checkExistCourseUser = $this->modelCourseUser->where('course_id', $courseId)->where('user_id', $userId)->orderBy('updated_at', 'desc')->first();
                if ($checkExistCourseUser) {
                    $checkExistCourseUser->delete();
                }
                $currentCourse = $this->modelCourse->findOrFail($courseId);
                $currentCourse->update(['seller' => $currentCourse->seller - 1]);
            }
        }
        // if course request is activate
        if ($requestAjax->statusId == Bill::ACTIVATED && $userId) {
            foreach ($courseIdList as $courseId) {
                $this->modelCourseUser->create(['user_id' => $userId, 'course_id' => $courseId]);
                $currentCourse = $this->modelCourse->findOrFail($courseId);
                $currentCourse->update(['seller' => $currentCourse->seller + 1]);


                // Generate data in progress
                $allLecture = $this->modelCourse->findOrFail($courseId)->lectures()->where('is_accepted', 1)->get();
                foreach($allLecture as $lecture) {
                    $this->modelProcess->create(['status' => 0, 'lecture_id' => $lecture->id, 'user_id' => $userId]);
                }
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
