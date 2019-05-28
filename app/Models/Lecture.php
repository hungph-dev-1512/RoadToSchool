<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $table = 'lectures';

    protected $fillable = [
        'title',
        'description',
        'video_link',
        'duration',
        'week',
        'index',
        'is_lecture',
        'is_quiz',
        'is_accepted',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function discussions()
    {
        return $this->hasMany('App\Models\Discussion');
    }

    public function lecture_comments()
    {
        return $this->hasMany('App\Models\LectureComment');
    }
}
