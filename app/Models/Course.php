<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    const SELLER_ASC = 'seller|asc';
    const SELLER_DESC = 'seller|desc';
    const PRICE_ASC = 'promotion_price|asc';
    const PRICE_DESC = 'promotion_price|desc';
    const LEVEL_ASC = 'level|asc';
    const LEVEL_DESC = 'level|desc';
    const DURATION_ASC = 'duration|asc';
    const DURATION_DESC = 'duration|desc';

    public static $filter_options = [
        self::SELLER_ASC => 'Sort By Lowest Seller',
        self::SELLER_DESC => 'Sort By Highest Seller',
        self::PRICE_ASC => 'Sort By Lowest Price',
        self::PRICE_DESC => 'Sort By Highest Price',
        self::LEVEL_ASC => 'Sort By Lowest Level',
        self::LEVEL_DESC => 'Sort By Highest Level',
        self::DURATION_ASC => 'Sort By Lowest Duration',
        self::DURATION_DESC => 'Sort By Highest Duration',
    ];

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

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function lectures()
    {
        return $this->hasMany('App\Models\Lecture');
    }

    public function getAllCourse($params = array())
    {
        $builder = Course::orderBy('updated_at', 'DESC')->where('is_accepted', 1);

        if (isset($params['filter_option']) && $params['filter_option']) {
             $filterCondition = $params['filter_option'];
             $partOfVerticalBar = explode("|", $filterCondition, 2);
             $fieldSearch = $partOfVerticalBar[0];
             $sortOption = $partOfVerticalBar[1];
             $builder->orderBy($fieldSearch, $sortOption);
        }
        if (isset($params['course_rate']) && $params['course_rate']) {
            $builder->where('course_rate', '>=', $params['course_rate']);
        }
        if (isset($params['keyword']) && $params['keyword']) {
            $builder->where('title', 'LIKE', '%' . $params['keyword'] . '%');
        }
        if (isset($params['sub_category_id']) && $params['sub_category_id']) {
            $categoryIdList = Category::where('id', $params['sub_category_id'])->pluck('id');
            $builder->whereIn('category_id', $categoryIdList);
        }
        if (isset($params['category_id']) && $params['category_id']) {
            $categoryIdList = Category::where('parent_id', $params['category_id'])->pluck('id');
            $builder->whereIn('category_id', $categoryIdList);
        }
        if (isset($params['user_id']) && $params['user_id']) {
            $builder->where('user_id', $params['user_id']);
        }

        return $builder->paginate(8)->appends(request()->except('page'));
    }

    public function findCourse($id)
    {
        return Course::findOrFail($id);
    }

    public function findMostRelatedCourse($id)
    {
        $selectedCategoryId = Course::findOrFail($id)->category_id;

        return Course::where('is_accepted', 1)->where('category_id', $selectedCategoryId)->orderBy('seller', 'desc')->limit(5)->get();
    }

    public function findRelatedCourseCount($id)
    {
        $selectedCategoryId = Course::findOrFail($id)->category_id;

        return Course::where('is_accepted', 1)->where('category_id', $selectedCategoryId)->get()->count();
    }
}
