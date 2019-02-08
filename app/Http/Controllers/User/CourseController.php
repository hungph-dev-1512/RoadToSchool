<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseUser;
use Auth;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $params = $request->all();
        $courses = $this->modelCourse->getAllCourse($params);
        if (isset($params['sub_category_id']) && $params['sub_category_id']) {
            $categoryId = $request->sub_category_id;
        }
        if (isset($params['category_id']) && $params['category_id']) {
            $categoryId = $request->category_id;
        }

        return view('user.courses.index', compact(
            'courses',
            'categoryId',
            'params'
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
        $availableCourse = null;
        if(Auth::check()) {
            $availableCourse = $this->modelCourseUser->where('course_id', $selectedCourse->id)->where('user_id', Auth::user()->id)->first();
        }
        $mostRelatedCourse = $this->modelCourse->findMostRelatedCourse($id);
        $relatedCourseCount = $this->modelCourse->findRelatedCourseCount($id);

        return view('user.courses.show', compact(
            'selectedCourse',
            'allLectures',
            'availableCourse',
            'mostRelatedCourse',
            'relatedCourseCount'
        ));
    }
}
