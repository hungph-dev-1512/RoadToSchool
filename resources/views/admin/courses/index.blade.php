@extends('admin.layouts.default')

@section('title')
    {{ __('titles.all_courses') }}
@endsection

@section('inline_styles')
    <link rel="stylesheet"
          href="{{ asset('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css') }}"/>
@endsection

@section('content')
    <div class="message-display">
        @include('flash::message')
    </div>
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
            <div class="card">
                <div class="card-body">
                    <div class="table-overflow">
                        <table id="dt-opt" class="table table-hover table-xl">
                            <thead>
                            <tr>
                                <th>{{ __('titles.title') }}</th>
                                <th>{{ __('titles.category') }}</th>
                                <th>{{ __('titles.seller') }}</th>
                                <th>{{ __('titles.instructor') }}</th>
                                <th>{{ __('titles.status') }}</th>
                                <th>{{ __('titles.action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($courses as $course)
                                <tr id="course{{ $course->id }}">
                                    <td>
                                        <a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.categories.index') }}">#{{ $course->category_id }}</a>
                                    </td>
                                    <td>
                                        {{ $course->seller }}
                                    </td>
                                    <td>
                                        <a href="{{ route('instructor_info', $course->user_id) }}">#{{ $course->user_id }}</a>
                                    </td>
                                    @if ($course->is_accepted === 0)
                                        <td>
                                            <span class="badge badge-pill badge-warning" id="label-status-course-{{ $course->id }}">{{ __('titles.pending') }}</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="badge badge-pill badge-success" id="label-status-course-{{ $course->id }}">{{ __('titles.accepted') }}</span>
                                        </td>
                                    @endif
                                    <td class="text-center font-size-18">
                                        @if ($course->is_accepted == 0)
                                            <a href="#" id="button-accept-course-{{ $course->id }}"
                                               class="text-gray m-r-15 button-accept-course" data-id="{{ $course->id }}" title="Accept Course"><i class="ti-check-box"></i></a>
                                        @endif
                                        <a class="text-gray" data-toggle="modal"
                                           data-target="#delete-modal" title="Delete Course"
                                           data-url="{{ route('admin.courses.destroy', $course->id) }}">
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

            $('.button-accept-course').on('click', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/admin/courses/' + $(this).data('id') + '/active',
                    type: 'post',
                    success: function (response) {
                        var responseData = jQuery.parseJSON(response);
                        var acceptedLabel = '{{ __('titles.accepted') }}';
                        $('#label-status-course-' + responseData.id).removeClass('badge-warning');
                        $('#label-status-course-' + responseData.id).addClass('badge-success');
                        $('#label-status-course-' + responseData.id).text(acceptedLabel);
                        $.notify({
                            // options
                            message: 'Couse <b>' + responseData.title + '</b> is accepted',
                            url: '/courses/' + responseData.id,
                        }, {
                            // settings
                            type: 'success',
                            placement: {
                                from: "bottom",
                                align: "right"
                            }
                        });
                        $('#button-accept-course-' + responseData.id).fadeOut(300);
                    }
                });
            });

            $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        })
    </script>
@endsection
