<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLike extends Model
{
    protected $table = 'course_likes';

    protected $fillable = [
        'course_id',
        'user_id',
    ];
}
