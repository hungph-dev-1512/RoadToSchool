<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $table = 'lectures';

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
