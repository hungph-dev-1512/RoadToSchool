<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Category;
use App\Models\CourseUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecture;
use Auth;

class CourseController extends Controller
{
    /**
     * The dependency model instance.
     */
    protected $modelCourse;
    protected $modelLecture;
    protected $modelCategory;
    protected $modelCourseUser;
    protected $modelUser;

    /**
     * Create a new controller instance.
     *
     * @param Course $course
     * @param Category $category
     * @return void
     */
    public function __construct(Course $course, Lecture $lecture, Category $category, CourseUser $courseUser, User $user)
    {
        $this->modelCourse = $course;
        $this->modelLecture = $lecture;
        $this->modelCategory = $category;
        $this->modelCourseUser = $courseUser;
    }

    public function index()
    {
        $instructorCourseList = $this->modelCourse->where('user_id', \Auth::user()->id)->get();

        return view('instructor.courses.index', compact(
            'instructorCourseList'
        ));
    }

    public function show($id)
    {
        $selectedCourse = $this->modelCourse->findOrFail($id);
        $allLectures = $selectedCourse->lectures;

        // Get lecture follow week and index
        $maxWeek = 0;
        foreach ($allLectures as $lecture) {
            if ($lecture->week > $maxWeek) {
                $maxWeek = $lecture->week;
            }
        }

        $lectureOutline = [];
        for ($i = 0; $i < $maxWeek; $i++) {
            $lectureOutline[$i] = $this->modelLecture->where('course_id', $id)->where('week', ($i + 1))->orderBy('index')->get();
        }

        $studentIdList = $this->modelCourseUser->where('course_id', $id)->pluck('user_id');
        $studentList = User::whereIn('id', $studentIdList)->get();
        foreach ($studentList as $student) {
            $processList = \App\Models\Process::whereIn('lecture_id', $selectedCourse->lectures()->pluck('id')->toArray())->where('user_id', $student->id);
            $learnedLectureCount = $processList->where('status', 1)->count();
            $allLectureCount = \App\Models\Process::whereIn('lecture_id', $selectedCourse->lectures()->pluck('id')->toArray())->where('user_id', $student->id)->count();
            if ($allLectureCount == 0) {
                $student->progress = 0;
            } else {
                $student->progress = round($learnedLectureCount / $allLectureCount * 100, 2);
            }
            $student->enrollCourseTime = $this->modelCourseUser->where('course_id', $id)->where('user_id', $student->id)->first()->created_at;
        }

        return view('instructor.courses.show', compact(
            'selectedCourse',
            'maxWeek',
            'lectureOutline',
            'studentList'
        ));
    }

    public function create()
    {
        $parentCategoryList = $this->modelCategory->where('parent_id', '')->get();
        foreach ($parentCategoryList as $parentCategory) {
            $parentCategory->childCategory = $this->modelCategory->where('parent_id', $parentCategory->id)->get();
        }

        return view('instructor.courses.create', compact(
            'parentCategoryList'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $result = $this->modelCourse->createNewCourse($data);

        if ($result) {
            flash(__('messages.create_course_successfully'))->success();
        } else {
            flash(__('messages.create_course_failed'))->error();
        }

        return redirect()->route('instructor.courses.index');
    }
}
