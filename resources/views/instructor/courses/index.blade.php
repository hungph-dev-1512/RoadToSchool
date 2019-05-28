@extends('admin.layouts.default')

@section('title')
    {{ __('titles.all_courses') }}
@endsection

@section('inline_styles')
    <link rel="stylesheet"
          href="{{ asset('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css') }}"/>
@endsection

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">{{ __('titles.all_courses') }}</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item">
                            <i class="ti-home p-r-5"></i>{{ __('titles.r2s_dashboard') }}
                            <a href="{{ route('admin.courses.index') }}" class="breadcrumb-item">
                                Courses
                            </a>
                            <a class="breadcrumb-item active">{{ __('titles.all_courses') }}</a>
                        </a>
                    </nav>
                </div>
            </div>
            @include('flash::message')
            <div class="card">
                <div class="card-body">
                    <div class="table-overflow">
                        <table id="dt-opt" class="table table-hover table-xl">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('titles.title') }}</th>
                                <th>{{ __('titles.category') }}</th>
                                <th>{{ __('titles.status') }}</th>
{{--                                <th>{{ __('titles.action') }}</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($instructorCourseList as $course)
                                <tr id="course{{ $course->id }}">
                                    <td>#{{ $course->id }}</td>
                                    <td>
                                        <a href="{{ route('instructor.courses.show', $course->id) }}">{{ $course->title }}</a>
                                    </td>
                                    <td>
                                        <a href="#todo">{{ $course->category->title }}</a>
                                    </td>
                                    <td>
                                        {{ $course->is_accepted ? 'Accepted' : 'Pending' }}
                                    </td>
{{--                                    <td class="text-center font-size-18">--}}
{{--                                        @if ($course->isActive === 0)--}}
{{--                                            <a href="{{ route('admin.active-course', $course->id) }}"--}}
{{--                                               class="text-gray m-r-15" title="accept"><i class="ti-check-box"></i></a>--}}
{{--                                        @endif--}}
{{--                                        <a class="text-gray" data-toggle="modal"--}}
{{--                                           data-target="#delete-modal"--}}
{{--                                           data-url="{{ route('admin.courses.destroy', $course->id) }}">--}}
{{--                                            <i class="ti-trash"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
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

@section('inline_scripts')
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/tables/data-table.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#delete-modal').on('show.bs.modal', function (e) {
                var url = $(e.relatedTarget).data('url');
                $('#form-delete').attr('action', url);
            });

            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        })
    </script>
@endsection
