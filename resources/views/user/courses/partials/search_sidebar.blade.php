<div id="search-row-wrapper">
    <div class="container">
        <div class="search-inner">
            <div class="row search-bar">
                <div class="advanced-search">
                    <form class="search-form" method="get" action="{{ route('courses.index') }}">
                        <div class="col-md-3 col-sm-6 search-col">
                            <input class="form-control keyword" name="keyword" value="{{ $params['keyword'] ?? '' }}"
                                   placeholder="{{ __('titles.keyword') }}" type="text">
                            <i class="fa fa-search"></i>
                        </div>
                        <div class="col-md-3 col-sm-6 search-col">
                            <div class="input-group-addon search-category-container">
                                <label class="styled-select">
                                    <select class="dropdown-product selectpicker" name="filter_option">
                                        <option value="0"> {{ __('titles.select_filter_option') }} </option>
                                        @foreach (App\Models\Course::$filter_options as $key => $value)
                                            <option value="{{ $key }}" {{ $key == ($params['filter_option'] ?? '') ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 search-col">
                            <div class="input-group-addon search-category-container">
                                <label class="styled-select rate-select">
                                    <select class="dropdown-product selectpicker" name="course_rate">
                                        <option value="0"> {{ __('titles.select_rate') }} </option>
                                        @for ($temp=1; $temp<=4; $temp++)
                                            <option value="{{ $temp }}" {{ $temp == ($params['course_rate'] ?? '') ? 'selected' : '' }}>
                                                @for ($tempStar=0; $tempStar<$temp; $tempStar++)
                                                    &#x2606;@endfor {{ __('titles.and_up') }}
                                            </option>
                                        @endfor
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 search-col">
                            <input class="btn btn-common btn-search btn-block" type="submit" value="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if(isset($categoryId))
    @php
        if(\App\Models\Category::where('id', $categoryId)->firstOrFail()->parent_id === 0) {
            $parentCategory =  \App\Models\Category::where('id', $categoryId)->firstOrFail();
            $categoryList = \App\Models\Category::where('parent_id', $categoryId)->get();
        } else if (\App\Models\Category::where('id', $categoryId)->firstOrFail()->parent_id !== 0) {
            $parentCategoryId = \App\Models\Category::where('id', $categoryId)->firstOrFail()->parent_id;
            $parentCategory = \App\Models\Category::where('id', $parentCategoryId)->firstOrFail();
            $categoryList = \App\Models\Category::where('parent_id', $parentCategoryId)->get();
            $activeCategoryId = $categoryId;
        }
    @endphp
    <div class="row" style="padding-top:50px">
        <div class="col-md-12" style="margin-left: 62px">
            <h3 class="section-title">Browse Courses in {{ $parentCategory->title }} Category</h3>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <div class="list-group list-group-horizontal">
                @foreach($categoryList as $category)
                    <a href="{{ route('courses.index', ['sub_category_id' => $category->id]) }}"
                       class="list-group-item {{ (isset($activeCategoryId) && (int)$activeCategoryId === $category->id) ? 'active' : '' }}"><strong>{{ $category->title . ' (' . App\Models\Course::where('is_accepted', 1)->where('category_id', $category->id)->count() . ')' }}</strong></a>
                @endforeach
            </div>
        </div>
        <style>
            .list-group-horizontal .list-group-item {
                display: inline-block;
            }

            .list-group-horizontal .list-group-item {
                margin-top: 10px;
                margin-bottom: 0;
                margin-left: -4px;
                margin-right: 0;
            }

            .list-group-horizontal .list-group-item:first-child {
                border-top-right-radius: 0;
                border-bottom-left-radius: 4px;
            }

            .list-group-horizontal .list-group-item:last-child {
                border-top-right-radius: 4px;
                border-bottom-left-radius: 0;
            }
        </style>
    </div>
@endif
