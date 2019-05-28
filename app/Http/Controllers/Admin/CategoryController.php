<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $modelCategory;

    /**
     * Create a new controller instance.
     *
     * @param Specialize $specialize
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->modelCategory = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $parentCategories = Category::all()->where('parent_id', 0)->pluck('title', 'id');
        $parentCategories[0] = 'No choice';

        return view('admin.categories.index', compact('categories', 'parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $result = $this->modelCategory->createCategory($data);

        if ($result) {
            flash(__('create status') . $result->id)->success();
        } else {
            flash(__('something wrong'))->error();
        }

        return redirect(route('admins.categories.index'));
    }
}
