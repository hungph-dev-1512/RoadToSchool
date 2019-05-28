<?php

namespace App\Http\Controllers\User;

use App\Models\Notification;
use App\Models\Comment;
use App\Models\LectureComment;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    protected $modelNotification;

    public function __construct(Notification $notification)
    {
        $this->modelNotification = $notification;
    }

    public function changeStatus(Request $request, $id)
    {
        $result = Notification::findOrFail($id)->update(['status' => Notification::SEEN]);
        $data = $request->all();
        if (Arr::exists($data, 'courseId')) {
            $parentCommentId = Comment::findOrFail($data['commentId'])->parent_comment;
            $typeComment = 'course';
            $lectureInCourseId = '';
        } elseif (Arr::exists($data, 'lectureId')) {
            $parentCommentId = LectureComment::findOrFail($data['commentId'])->parent_comment;
            $typeComment = 'lecture';
            $lectureInCourseId = Lecture::findOrFail($data['lectureId'])->course->id;
        }
        if ($parentCommentId) {
            $data['parentCommentId'] = $parentCommentId;
        }
        $data['$typeComment'] = $typeComment;
        $data['lectureInCourseId'] = $lectureInCourseId;

        if ($result) {
            return $data;
        }

        return 500;
    }

    public function index()
    {
        $notificationQuery = $this->modelNotification->where('user_id', \Auth::user()->id)->orderBy('created_at', 'desc');
        $notificationList = $notificationQuery->paginate(12);
        $unreadNotificationCount = $notificationQuery->where('status', 0)->count();

        return view('user.notifications.index', compact(
            'notificationList',
            'unreadNotificationCount'
        ));
    }
}
