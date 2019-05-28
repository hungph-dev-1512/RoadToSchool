@extends('admin.layouts.default')

@section('title')
    {{ __('titles.all_categories') }}
@endsection

@section('inline_styles')
    <link rel="stylesheet"
          href="{{ asset('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin-custom.css') }}">
@endsection

@section('content')
    <div class="message-display">
        @include('flash::message')
    </div>
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">{{ __('titles.all_categories') }}</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item">
                            <i class="ti-home p-r-5"></i>{{ __('titles.r2s_dashboard') }}
                        </a>
                        <a class="breadcrumb-item"
                           href="{{ route('admin.categories.index') }}">{{ __('titles.categories') }}</a>
                        <a class="breadcrumb-item active">{{ __('titles.all_categories') }}</a>
                    </nav>
                </div>
            </div>
            <div class="create-btn">
                <a class="btn btn-gradient-success btn-rounded" data-toggle="modal"
                   data-target="#create-categories-modal">
                    {{ __('titles.create_new_category') }} <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-overflow">
                        <table id="dt-opt" class="table table-hover table-xl">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('titles.title') }}</th>
                                <th>{{ __('titles.parent_category') }}</th>
                                <th>{{ __('titles.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr id="category{{ $category->id }}">
                                    <td>#{{ $category->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->title }}</a>
                                    </td>
                                    @if ($category->parent_id !== 0)
                                        <td>{{ $category->getParentCategoryById($category->parent_id)->title }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td class="text-center font-size-18">
                                        <a class="text-gray" data-toggle="modal"
                                           data-target="#delete-modal"
                                           data-url="{{ route('admin.categories.destroy', $category->id) }}">
                                            <i class="ti-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin.layouts.delete_modal')
@include('admin.categories.create_category_modal', ['parentCategories' => $parentCategories])

@section('inline_scripts')
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/tables/data-table.js') }}"></script>
    <script>
        $(document).ready(function () {
            @if (count($errors) > 0)
            $('#create-categories-modal').modal('show');
            @endif

            $('#delete-modal').on('show.bs.modal', function (e) {
                var url = $(e.relatedTarget).data('url');
                $('#form-delete').attr('action', url);
            });

            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        })
    </script>
@endsection
