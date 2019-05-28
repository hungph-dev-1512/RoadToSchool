<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getSubCategoryList(Request $request, $parentCategoryId)
    {
        return json_encode(\App\Models\Category::where('parent_id', $parentCategoryId)->get());
    }
}
