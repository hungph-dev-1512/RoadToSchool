<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Course;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * The user repository instance.
     */
    protected $modelUser;
    protected $modelBill;
    protected $modelCourse;

    /**
     * Create a new controller instance.
     *
     * @param User $users
     * @return void
     */
    public function __construct(Bill $bill, User $user, Course $course)
    {
        $this->modelBill = $bill;
        $this->modelUser = $user;
        $this->modelCourse = $course;
    }

    public function index()
    {
        $newestBills = $this->modelBill->orderBy('created_at', 'desc')
            ->limit(4)->get();
        $count['adminsCount'] = $this->modelUser->where('is_admin', 1)->count();
        $count['teachersCount'] = $this->modelUser->where('role', 1)->count();
        $count['studentsCount'] = $this->modelUser->where('role', 2)->count();
        $count['totalUsers'] = $this->modelUser->count();
        $excellentInstructors = $this->modelUser->where('role', 1)->orderBy('instructor_rate', 'desc')->limit(6)->get();

        $mostSellerCourseList = $this->modelCourse->where('is_accepted', 1)->orderBy('seller', 'desc')->limit(4)->get();

        return view('admin.home', compact('newestBills', 'count', 'excellentInstructors', 'mostSellerCourseList'));
    }
}
