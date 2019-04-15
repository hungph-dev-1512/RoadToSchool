<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Discussion;
use App\Models\LectureComment;
use App\Models\Notification;
use Embed\Embed;
use Illuminate\Http\Request;
use App\Events\GetLectureCommentFromPusherEvent;
use App\Events\GetReplyLectureCommentFromPusherEvent;
use App\Events\GetNotificationFromPusherEvent;

class LectureController extends Controller
{
    // protected $modelLecture;
    protected $modelDiscussion;
    protected $modelLectureComment;
    protected $modelNotification;

    public function __construct(Discussion $discussion, LectureComment $lectureComment, Notification $notification)
    {
        $this->modelDiscussion = $discussion;
        $this->modelLectureComment = $lectureComment;
        $this->modelNotification = $notification;
    }

    public function show($id, $lectureId)
    {
        $link = Lecture::find($lectureId)->video_link;
        $description = Lecture::find($lectureId)->description;
        $teacher = Course::find($id)->user;
        $embed = Embed::create($link);
        $lectures = Course::find($id)->lectures;
        $lectureComments = $this->modelLectureComment->where('lecture_id', $lectureId)->get();

        // Get all discussions in lecture
        $discussionsList = $this->modelDiscussion->where('lecture_id', $lectureId)->orderBy('created_at')->get();
        // Get all child lecture comment set to collection lecture comment
        foreach ($lectureComments as $lectureComment) {
            $lectureComment->child_comments = $this->modelLectureComment->where('parent_comment', $lectureComment->id)->orderBy('updated_at', 'asc')->get();
        }

        return view('user.lectures.show', compact(
            'embed',
            'lectures',
            'id',
            'description',
            'teacher',
            'lectureId',
            'discussionsList',
            'lectureComments'
        ));
    }

    public function postCommentToPusher(Request $request, $lectureId)
    {
        $data = $request->all();
        $data['user_id'] = $data['userId'];
        $data['lecture_id'] = $lectureId;

        $createdLectureComment = $this->modelLectureComment->storeNewLectureComment($data);
        $lectureCommentedUserList = $this->modelLectureComment->where('lecture_id', $lectureId)->whereNull('parent_comment')->where('user_id', '!=', $data['user_id'])->groupBy('user_id')->pluck('user_id');
        // Create Notification
        $createdNotification = $this->modelNotification->createCommentNotification($lectureId, $lectureCommentedUserList, $createdLectureComment, Notification::LECTURE_COMMENT);
        $notificationContent = $createdLectureComment->user->name . ' has commented in lecture ' . Lecture::findOrFail($lectureId)->title . ': ' . $createdLectureComment->content;
        $createNotificationIdList = $this->modelNotification->where('comment_id', $createdLectureComment->id)->pluck('id', 'user_id');

        if($createdLectureComment && $createdNotification) {
//        if($createdLectureComment) {
            event(new GetLectureCommentFromPusherEvent($request, $createdLectureComment));
            event(new GetNotificationFromPusherEvent($lectureId, $lectureCommentedUserList, $createdLectureComment, $notificationContent, $createdLectureComment->user->avatar, \Carbon\Carbon::parse($createdLectureComment->created_at)->diffForHumans(), $createNotificationIdList));

            return 200;
        }

        return 500;
    }

    public function postReplyLectureCommentToPusher(Request $request, $lectureId, $parentCommentId)
    {
        $data = $request->all();
        $data['user_id'] = $data['userId'];
        $data['lecture_id'] = $lectureId;
        $data['parent_comment'] = $parentCommentId;

        $createdComment = $this->modelLectureComment->storeNewLectureComment($data);
//        $commentedUserList = $this->modelComment->where('user_id', '!=', $data['user_id'])->where('course_id', $courseId)->where('parent_comment', $parentCommentId)->groupBy('user_id')->pluck('user_id');
//        $createdNotification = $this->modelNotification->createCommentNotification($courseId, $commentedUserList, $createdComment, 'replied');
//        if($createdComment && $createdNotification) {
        if($createdComment) {
            event(new GetReplyLectureCommentFromPusherEvent($request, $createdComment, $parentCommentId));

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
