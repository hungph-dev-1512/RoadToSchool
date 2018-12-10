<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get the teacher that teach the course.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function cart_items()
    {
        return $this->hasMany('App\Models\CartItem');
    }

    public function lectures()
    {
        return $this->hasMany('App\Models\Lecture');
    }

    public function getAllCourse()
    {
        return Course::paginate(8);
    }

    public function findCourse($id)
    {
        return Course::findOrFail($id);
    }
}
