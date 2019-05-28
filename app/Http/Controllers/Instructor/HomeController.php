<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Bill;
use App\Models\CourseUser;
use App\Models\Course;
use App\Models\Comment;
use App\Models\LectureComment;
use App\Models\Lecture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * The user repository instance.
     */
    protected $modelCourseUser;
    protected $modelCourse;
    protected $modelComment;
    protected $modelLectureComment;
    protected $modelLecture;

    /**
     * Create a new controller instance.
     *
     * @param User $users
     * @return void
     */
    public function __construct(CourseUser $courseUser, Course $course, Comment $comment, LectureComment $lectureComment, Lecture $lecture)
    {
        $this->modelCourseUser = $courseUser;
        $this->modelCourse = $course;
        $this->modelComment = $comment;
        $this->modelLectureComment = $lectureComment;
        $this->modelLecture = $lecture;
    }

    public function index()
    {
        $instructorCourseListQuery = $this->modelCourse->where('user_id', \Auth::user()->id);
        $instructorCourseListQueryCopy = $this->modelCourse->where('user_id', \Auth::user()->id);
        $newestInstructorCourseList = $instructorCourseListQuery->orderBy('updated_at', 'desc')->limit(8)->get();
        $instructorCourseIdList = $instructorCourseListQueryCopy->pluck('id')->toArray();
        foreach ($newestInstructorCourseList as $course) {
            $course['student_count'] = $this->modelCourseUser->where('course_id', $course->id)->count();
        }
        $commentInCourse = $this->modelComment->whereIn('course_id', $instructorCourseIdList)->orderBy('updated_at', 'desc')->limit(5)->get();

        $lectureListInCourse = $this->modelLecture->whereIn('course_id', $instructorCourseIdList)->pluck('id')->toArray();
        $commentInLecture = $this->modelLectureComment->whereIn('lecture_id', $lectureListInCourse)->orderBy('updated_at', 'desc')->limit(5)->get();

        return view('instructor.home', compact(
            'newestInstructorCourseList',
            'commentInCourse',
            'commentInLecture'
        ));
    }
}
