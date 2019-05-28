<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'type',
        'content',
        'status',
        'course_id',
        'lecture_id',
        'comment_id',
        'user_id',
    ];

    const WELCOME = 0;
    const COMMENT = 1;
    const LECTURE_COMMENT = 2;

    public static $type = [
        self::WELCOME => 'Welcome Notification',
        self::COMMENT => 'Comment Notification',
        self::LECTURE_COMMENT => 'Lecture Comment Notification'
    ];

    const NOT_SEEN = 0;
    const SEEN = 1;

    public static $status = [
        self::NOT_SEEN => 'Not seen',
        self::SEEN => 'Seen',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function createCommentNotification($courseOrLectureId, $userIdList, $comment, $type)
    {
        DB::beginTransaction();
        if ($type == self::COMMENT) {
            foreach ($userIdList as $userId) {
                $result =
                    Notification::create([
                        'type' => self::COMMENT,
                        'content' => '<b>' . $comment->user->name . '</b> has commented in <b>' . Course::findOrFail($courseOrLectureId)->first()->title . '</b>: ' . $comment->content,
                        'status' => self::NOT_SEEN,
                        'course_id' => $courseOrLectureId,
                        'comment_id' => $comment->id,
                        'user_id' => $userId
                    ]);

                if (!$result) {
                    return false;
                }
            }
        } elseif ($type == self::LECTURE_COMMENT) {
            foreach ($userIdList as $userId) {
                $result =
                    Notification::create([
                        'type' => self::LECTURE_COMMENT,
                        'content' => '<b>' . $comment->user->name . '</b> has commented in lecture <b>' . Lecture::findOrFail($courseOrLectureId)->title . '</b>: ' . $comment->content,
                        'status' => self::NOT_SEEN,
                        'lecture_id' => $courseOrLectureId,
                        'comment_id' => $comment->id,
                        'user_id' => $userId
                    ]);

                if (!$result) {
                    return false;
                }
            }
        }

        DB::commit();

        return true;
    }

    public static function createWelcomeNotification($userId)
    {
        $data['type'] = self::WELCOME;
        $data['content'] = 'Welcome to Road To School';
        $data['status'] = 0;
        $data['user_id'] = $userId;
        return Notification::create($data);
    }
}
