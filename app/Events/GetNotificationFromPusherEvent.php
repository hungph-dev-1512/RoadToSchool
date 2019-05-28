<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GetNotificationFromPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $courseOrLectureId;
    public $commentedUserList;
    public $createdComment;
    public $commentContent;
    public $userAvatar;
    public $diffTime;
    public $createNotificationIdList;
    public $dataLectureCommentCourseId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($courseOrLectureId, $commentedUserList, $createdComment, $commentContent, $userAvatar, $diffTime, $createNotificationIdList)
    {
        $this->courseOrLectureId = $courseOrLectureId;
        $this->commentedUserList = $commentedUserList;
        $this->createdComment = $createdComment;
        $this->commentContent = $commentContent;
        $this->userAvatar = $userAvatar;
        $this->diffTime = $diffTime;
        $this->createNotificationIdList = $createNotificationIdList;
        if ($createdComment->lecture_id) {
            $this->dataLectureCommentCourseId = \App\Models\Lecture::findOrFail($createdComment->lecture_id)->course->id;
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['notification'];
    }
}
