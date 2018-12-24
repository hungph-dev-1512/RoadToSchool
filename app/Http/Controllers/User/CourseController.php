<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\CourseUser;
use Auth;

class CourseController extends Controller
{
    /**
     * The dependency model instance.
     */
    protected $modelCourse;
    protected $modelCategory;
    protected $modelCourseUser;

    /**
     * Create a new controller instance.
     * 
     * @param Course $course
     * @param Category $category
     * @return void
     */
    public function __construct(Course $course, Category $category, CourseUser $courseUser)
    {
        $this->modelCourse = $course;
        $this->modelCategory = $category;
        $this->modelCourseUser = $courseUser;
    }

    public function index()
    {
        $courses = $this->modelCourse->getAllCourse();
        $categories = $this->modelCategory->getAllCategory();

        return view('user.courses.index', compact(
            'courses',
            'categories'
        ));
    }

    /**
     * Display a course of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $selectedCourse = $this->modelCourse->findCourse($id);
        $allLectures = $selectedCourse->lectures;
        $availableCourse = $this->modelCourseUser->where('course_id', $selectedCourse->id)->where('user_id', Auth::user()->id)->first();

        return view('user.courses.show', compact(
            'selectedCourse',
            'allLectures',
            'availableCourse'
        ));
    }
}
