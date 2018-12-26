<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }

    public function getAllCategory()
    {
        return Category::all();
    }
}
