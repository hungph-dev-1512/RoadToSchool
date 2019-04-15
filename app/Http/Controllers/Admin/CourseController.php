<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    protected $modelCourse;

    public function __construct(Course $course)
    {
        $this->modelCourse = $course;
    }

    public function index()
    {
        $courses = Course::all();

        return view('admin.courses.index', compact('courses'));
    }
}
