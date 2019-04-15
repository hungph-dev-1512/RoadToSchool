<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Events\GetCommentFromPusherEvent;
use App\Events\GetReplyCommentFromPusherEvent;
use App\Events\GetNotificationFromPusherEvent;

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

    /**
     * Create a new controller instance.
     *
     * @param Course $course
     * @param Category $category
     * @return void
     */
    public function __construct(User $user, Course $course, Category $category, CourseUser $courseUser, Comment $comment, Notification $notification)
    {
        $this->modelUser = $user;
        $this->modelCourse = $course;
        $this->modelCategory = $category;
        $this->modelCourseUser = $courseUser;
        $this->modelComment = $comment;
        $this->modelNotification = $notification;
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
        if (Auth::check()) {
            $availableCourse = $this->modelCourseUser->where('course_id', $selectedCourse->id)->where('user_id', Auth::user()->id)->first();
        }
        $mostRelatedCourse = $this->modelCourse->findMostRelatedCourse($id);
        $relatedCourseCount = $this->modelCourse->findRelatedCourseCount($id);
        $comments = $this->modelComment->where('course_id', $id)->where('parent_comment', null)->orderBy('updated_at', 'asc')->get();
        foreach ($comments as $comment) {
            $comment->child_comments = $this->modelComment->where('parent_comment', $comment->id)->orderBy('updated_at', 'asc')->get();
        }

        return view('user.courses.show', compact(
            'selectedCourse',
            'allLectures',
            'availableCourse',
            'mostRelatedCourse',
            'relatedCourseCount',
            'comments'
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
        if($data['taggedUser'] && $data['taggedUser'] != Auth::user()->id) {
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
        $replacedString = str_replace($name, '<a href="http://127.0.0.1:8000/users/' . $taggedUser->id . '" style="color: #3498db">'. $taggedUser->name . '</a>', $string);

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

        if($createdComment && $createdNotification) {
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
        if($createdComment && $createdNotification) {
            event(new GetReplyCommentFromPusherEvent($request, $createdComment, $parentCommentId));

            if($data['firstChildComment'] == 'false') {
                $responseData['prevCommentId'] = $data['prevCommentId'];
                $responseData['parentCommentId'] = $parentCommentId;

                return json_encode($responseData);
            }

            return json_encode($parentCommentId);
        }

        return 500;
    }
}
