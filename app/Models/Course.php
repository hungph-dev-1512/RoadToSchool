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

    public function getAllCourse($params = array())
    {
        $builder = Course::orderBy('updated_at', 'DESC');

        if (isset($params['course_level']) && $params['course_level']) {
            $builder->where('level', $params['course_level']);
        }
        if (isset($params['course_rate']) && $params['course_rate']) {
            $builder->where('course_rate', '>=', $params['course_rate']);
        }
        if (isset($params['keyword']) && $params['keyword']) {
            $builder->where('title', 'LIKE', '%' . $params['keyword'] . '%');
        }
        if (isset($params['category_id']) && $params['category_id']) {
            $categoryId = Category::where('id', $params['category_id'])->pluck('id');
            $builder->whereIn('category_id', $categoryId);
        }

        return $builder->paginate(8);
    }

    public function findCourse($id)
    {
        return Course::findOrFail($id);
    }
}
