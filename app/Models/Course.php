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

    protected $fillable = [
        'title',
        'course_avatar',
        'course_avatar_2',
        'course_avatar_3',
        'description',
        'origin_price',
        'promotion_price',
        'lecture_numbers',
        'duration',
        'seller',
        'level',
        'course_rate',
        'is_accepted',
        'category_id',
        'user_id',
    ];

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

    public function createNewCourse($data)
    {
        $courseAvatarList = $data['image'];
        $data['course_avatar'] = 'public/images/dummy_image/' . $courseAvatarList[0];
        $data['course_avatar_2'] = 'public/images/dummy_image/' . $courseAvatarList[1];
        $data['course_avatar_3'] = 'public/images/dummy_image/' . $courseAvatarList[2];
        $data['origin_price'] = 0;
        $data['lecture_numbers'] = 0;
        $data['duration'] = 0;
        $data['seller'] = 0;
        $data['course_rate'] = 0;
        $data['is_accepted'] = 0;
        $data['user_id'] = \Auth::user()->id;

        return Course::create($data);
    }
}
