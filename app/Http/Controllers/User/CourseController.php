<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Comment;
use App\Models\Lecture;
use App\Models\Notification;
use App\Models\User;
use App\Models\CourseLike;
use App\Models\Process;
use Auth;
use Illuminate\Http\Request;
use App\Events\GetCommentFromPusherEvent;
use App\Events\GetReplyCommentFromPusherEvent;
use App\Events\GetNotificationFromPusherEvent;
use App\Events\GetLikeCountFromPusherEvent;

class CourseController extends Controller
{
    /**
     * The dependency model instance.
     */
    protected $modelUser;
    protected $modelCourse;
    protected $modelCategory;
    protected $modelCourseUser;
    protected $modelComment;
    protected $modelNotification;
    protected $modelCourseLike;
    protected $modelLecture;
    protected $modelProcess;

    /**
     * Create a new controller instance.
     *
     * @param Course $course
     * @param Category $category
     * @return void
     */
    public function __construct(
        User $user, Course $course,
        Category $category,
        CourseUser $courseUser,
        Comment $comment,
        Notification $notification,
        CourseLike $courseLike,
        Lecture $lecture,
        Process $process
    )
    {
        $this->modelUser = $user;
        $this->modelCourse = $course;
        $this->modelCategory = $category;
        $this->modelCourseUser = $courseUser;
        $this->modelComment = $comment;
        $this->modelNotification = $notification;
        $this->modelCourseLike = $courseLike;
        $this->modelLecture = $lecture;
        $this->modelProcess = $process;
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
        $allLectures = $selectedCourse->lectures()->where('is_accepted', 1)->get();

        // Get lecture follow week and index
        $maxWeek = 0;
        foreach ($allLectures as $lecture) {
            if ($lecture->week > $maxWeek) {
                $maxWeek = $lecture->week;
            }
        }

        $lectureOutline = [];
        for ($i = 0; $i < $maxWeek; $i++) {
            $lectureOutline[$i] = $this->modelLecture->where('course_id', $id)->where('is_accepted', 1)->where('week', ($i + 1))->orderBy('index')->get();
        }

        $availableCourse = null;
        if (Auth::check()) {
            $availableCourse = $this->modelCourseUser->where('course_id', $selectedCourse->id)->where('user_id', Auth::user()->id)->first();
        }

        if (!(\Auth::user()->is_admin || \Auth::user()->role == 1)) {
            // Get process
            $allLectureCount = $allLectures->count();
            $learnedLectureCount = 0;
            if ($availableCourse) {
                foreach ($allLectures as $lecture) {
                    $learnStatus = $this->modelProcess->where('lecture_id', $lecture->id)->where('user_id', \Auth::user()->id)->first()->status;
                    if ($learnStatus) {
                        $learnedLectureCount++;
                    }
                }
            }
        }

        $mostRelatedCourse = $this->modelCourse->findMostRelatedCourse($id);
        $relatedCourseCount = $this->modelCourse->findRelatedCourseCount($id);
        $comments = $this->modelComment->where('course_id', $id)->where('parent_comment', null)->orderBy('updated_at', 'asc')->get();
        foreach ($comments as $comment) {
            $comment->child_comments = $this->modelComment->where('parent_comment', $comment->id)->orderBy('updated_at', 'asc')->get();
        }
        // Check current user has liked course
        $checkResult = $this->modelCourseLike->where('course_id', $id)->where('user_id', \Auth::user()->id)->first();
        if ($checkResult) {
            $liked = 1;
        } else {
            $liked = 0;
        }

//        dd($allLectures);
        return view('user.courses.show', compact(
            'selectedCourse',
            'allLectures',
            'maxWeek',
            'availableCourse',
            'mostRelatedCourse',
            'relatedCourseCount',
            'comments',
            'liked',
            'lectureOutline',
            'allLectureCount',
            'learnedLectureCount'
        ));
    }

    public function createNewComment(Request $request, $courseId)
    {
        $data = $request->all();
        $data['course_id'] = $courseId;

        $createdComment = $this->modelComment->storeNewComment($data);

        if ($createdComment) {
            return redirect()->back();
        }

        return 404;
    }

    public function replyComment(Request $request, $courseId, $commentId)
    {
        $data = $request->all();
        $data['course_id'] = $courseId;
        $data['parent_comment'] = $commentId;
        if ($data['taggedUser'] && $data['taggedUser'] != Auth::user()->id) {
            $data['content'] = self::preProcess($data['content'], $data['taggedUser']);
        }

        $createdComment = $this->modelComment->storeNewComment($data);

        if ($createdComment) {
            return redirect()->back();
        }

        return 404;
    }

    public function preProcess($string, $taggedUser)
    {
        $taggedUser = $this->modelUser->findOrFail($taggedUser);
        $namePosition = strpos($string, $taggedUser->name);
        $name = substr($string, $namePosition, $namePosition + strlen($taggedUser->name));
        $replacedString = str_replace($name, '<a href="http://127.0.0.1:8000/users/' . $taggedUser->id . '" style="color: #3498db">' . $taggedUser->name . '</a>', $string);
        return $replacedString;
    }

    public function postCommentToPusher(Request $request, $courseId)
    {
        $data = $request->all();
        $data['user_id'] = $data['userId'];
        $data['course_id'] = $courseId;

        $createdComment = $this->modelComment->storeNewComment($data);
        $commentedUserList = $this->modelComment->where('course_id', $courseId)->whereNull('parent_comment')->where('user_id', '!=', $data['user_id'])->groupBy('user_id')->pluck('user_id');
        // Create Notification
        $createdNotification = $this->modelNotification->createCommentNotification($courseId, $commentedUserList, $createdComment, Notification::COMMENT);
        $notificationContent = '<b>' . $createdComment->user->name . '</b> has commented in <b>' . Course::findOrFail($courseId)->first()->title . '</b>: ' . $createdComment->content;
        $createNotificationIdList = $this->modelNotification->where('comment_id', $createdComment->id)->pluck('id', 'user_id');

        if ($createdComment && $createdNotification) {
            event(new GetCommentFromPusherEvent($request, $createdComment));
            event(new GetNotificationFromPusherEvent($courseId, $commentedUserList, $createdComment, $notificationContent, $createdComment->user->avatar, \Carbon\Carbon::parse($createdComment->created_at)->diffForHumans(), $createNotificationIdList));

            return 200;
        }

        return 500;
    }

    public function postReplyCommentToPusher(Request $request, $courseId, $parentCommentId)
    {
        $data = $request->all();
        $data['user_id'] = $data['userId'];
        $data['course_id'] = $courseId;
        $data['parent_comment'] = $parentCommentId;

        $createdComment = $this->modelComment->storeNewComment($data);
        $commentedUserList = $this->modelComment->where('user_id', '!=', $data['user_id'])->where('course_id', $courseId)->where('parent_comment', $parentCommentId)->groupBy('user_id')->pluck('user_id');
        $createdNotification = $this->modelNotification->createCommentNotification($courseId, $commentedUserList, $createdComment, 'replied');
        if ($createdComment && $createdNotification) {
            event(new GetReplyCommentFromPusherEvent($request, $createdComment, $parentCommentId));

            if ($data['firstChildComment'] == 'false') {
                $responseData['prevCommentId'] = $data['prevCommentId'];
                $responseData['parentCommentId'] = $parentCommentId;

                return json_encode($responseData);
            }

            return json_encode($parentCommentId);
        }

        return 500;
    }

    public function postAppreciate(Request $request, $courseId)
    {
        $data = $request->all();
        $selectedCourseUser = $this->modelCourseUser->where('course_id', $courseId)->where('user_id', Auth::user()->id)->first();
        $result = $selectedCourseUser->update(['rate' => $data['star'], 'appreciate' => $data['appreciate_content']]);
        if ($result) {
            flash(__('messages.appreciate_course_successfully'))->success();
        } else {
            flash(__('messages.appreciate_course_failed'))->error();
        }

        return redirect()->back();
    }
//
//    public function changeLikeStatus(Request $request, $courseId, $userId, $status)
//    {
//        $likeCount = $this->modelCourse->findOrFail($courseId)->like;
//        // Unlike to Like
//        if ($status == 0) {
//            $this->modelCourseLike->create(['course_id' => $courseId, 'user_id' => $userId]);
//            $newLikeCount = $likeCount + 1;
//            $this->modelCourse->findOrFail($courseId)->update(['like' => $newLikeCount]);
//        } else if ($status == 1) {
//            // Like to Unlike
//            $selectedId = $this->modelCourseLike->where('course_id', $courseId)->where('user_id', $userId)->first();
//            $selectedId->delete();
//            $newLikeCount = $likeCount - 1;
//            $this->modelCourse->findOrFail($courseId)->update(['like' => $newLikeCount]);
//        }
//        event(new GetLikeCountFromPusherEvent($newLikeCount));
//
//        return 201;
//    }

    public function getMyCourse($userId)
    {
        $courseIdList = $this->modelCourseUser->where('user_id', $userId)->pluck('course_id')->toArray();
        $courseList = $this->modelCourse->whereIn('id', $courseIdList)->get();
        foreach($courseList as $course) {
            $processList = \App\Models\Process::whereIn('lecture_id', $course->lectures()->pluck('id')->toArray())->where('user_id', \Auth::user()->id);
            $learnedLectureCount = $processList->where('status', 1)->count();
            $allLectureCount = \App\Models\Process::whereIn('lecture_id', $course->lectures()->pluck('id')->toArray())->where('user_id', \Auth::user()->id)->count();
            if($allLectureCount == 0) {
                $course->process = 0;
                $course->learnedCount = 0;
                $course->totalLecture = 0;
            } else {
                $course->process = round($learnedLectureCount/$allLectureCount*100, 2);
                $course->learnedCount = $learnedLectureCount;
                $course->totalLecture = $allLectureCount;
            }
        }

        return view('user.courses.my_course', compact(
            'courseList'
        ));
    }
}
