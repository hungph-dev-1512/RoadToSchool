<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LectureComment extends Model
{
    protected $table = 'lecture_comments';

    protected $fillable = [
        'content',
        'parent_comment',
        'lecture_id',
        'user_id',
    ];

    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function storeNewLectureComment($data)
    {
        return LectureComment::create($data);
    }
}
