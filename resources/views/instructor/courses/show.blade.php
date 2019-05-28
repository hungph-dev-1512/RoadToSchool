@extends('admin.layouts.default')

@section('title')
    {{ __('titles.all_courses') }}
@endsection

@section('inline_styles')
    <link rel="stylesheet"
          href="{{ asset('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css') }}"/>
@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">{{ $selectedCourse->title }}</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="#" class="breadcrumb-item"><i class="ti-home p-r-5"></i>Home</a>
                        <a class="breadcrumb-item" href="{{ route('instructor.courses.index') }}">Courses</a>
                        <span class="breadcrumb-item active">{{ $selectedCourse->title }}</span>
                    </nav>
                </div>
            </div>
            @include('flash::message')
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border bottom">
                            <h4 class="card-title">Course Image</h4>
                        </div>
                        <div class="card-body">
                            <div class="row m-t-25">
                                <div class="col-md-12" style="height: 300px;">
                                    <div id="carouselExampleCaption" class="carousel slide"
                                         data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carouselExampleCaption" data-slide-to="0"
                                                class="active"></li>
                                            <li data-target="#carouselExampleCaption" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleCaption" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <div class="bg-overlay">
                                                    <img class="d-block w-100"
                                                         src="{{ asset(str_replace('public/', '', $selectedCourse->course_avatar)) }}"
                                                         alt="First slide">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h4 class="text-white">Course Image 1</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="bg-overlay">
                                                    <img class="d-block w-100"
                                                         src="{{ asset(str_replace('public/', '', $selectedCourse->course_avatar_2)) }}"
                                                         alt="Second slide">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h4 class="text-white">Course Image 2</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="bg-overlay">
                                                    <img class="d-block w-100"
                                                         src="{{ asset(str_replace('public/', '', $selectedCourse->course_avatar_3)) }}"
                                                         alt="Third slide">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h4 class="text-white">Course Image 3</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleCaption"
                                       role="button" data-slide="prev">
                                                    <span class="mdi mdi-chevron-left font-size-35"
                                                          aria-hidden="true"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleCaption"
                                       role="button" data-slide="next">
                                                    <span class="mdi mdi-chevron-right font-size-35"
                                                          aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                            <br><br>
                            <div class="text-right">
                                <button class="btn btn-gradient-success">Edit</button>
                                <button class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border bottom">
                            <h4 class="card-title">Course Course Information</h4>
                        </div>
                        <div class="card-body">
                            <p class="no-margin ">
                                <i class="fa fa-user-circle" id="share"></i> &ensp;
                                <strong> {{ __('titles.teacher') }} </strong><a
                                        href="{{ route('instructor_info', $selectedCourse->user->id) }}"> {{ $selectedCourse->user->name }} </a>
                            </p>
                            <p class="no-margin">
                                <i class="fa fa-th" id="share"></i> &ensp;
                                <strong> {{ __('titles.category') }} </strong> <a
                                        href="/courses?sub_category_id={{ $selectedCourse->category->id }}"> {{ $selectedCourse->category->title }} </a>
                            </p>
                            <p class="no-margin">
                                <i class="fa fa-window-maximize" id="share"></i> &ensp;
                                <strong> {{ __('titles.lectures_1') }} </strong> {{ $selectedCourse->lectures->count() . ' ' . __('titles.lectures') }}
                            </p>
                            <p class="no-margin">
                                <i class="fa fa-clock-o" id="share"></i> &ensp;
                                <strong> {{ __('titles.duration') }} </strong> {{ $selectedCourse->duration . ' ' . __('titles.minutes')}}
                            </p>
                            <p class="no-margin">
                                <i class="fa fa-credit-card"></i> &ensp;
                                <strong> {{ __('titles.seller') }} </strong> {{ $selectedCourse->seller }} </p>
                            <p class="no-margin">
                                <i class="fa fa-edit"></i> &ensp;
                                <strong> {{ __('titles.last_update_at') }} </strong> {{ $selectedCourse->updated_at }}
                            </p>
                            <p class="no-margin">
                                <i class="fa fa-exchange"></i> &ensp;
                                <strong> {{ __('titles.status') }} </strong> {{ $selectedCourse->is_accepted ? 'Accepted' : 'Pending acccept from admin' }}
                            </p>
                            {{--                            <div class="text-right">--}}
                            {{--                                <button class="btn btn-gradient-success">Edit</button>--}}
                            {{--                                <button class="btn btn-default">Cancel</button>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        @php
                            $tempLectureCount = 1;
                            $tempQuizCount = 1;
                        @endphp
                        <div class="card-header border bottom">
                            <h4 class="card-title">Lecture List</h4>
                            <a href="{{ route('instructor.courses.lectures.create', $selectedCourse->id) }}"
                               class="text-gray m-r-15 edit-status pull-right" style="padding-top: 7px;"><i
                                        class="ti-plus"></i> Add new lecture</a>
                        </div>
                        <div class="card-body">
                            @for($i = 0; $i < $maxWeek; $i++)
                                <h3>Week {{ $i + 1 }}</h3>
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 10%">Status</th>
                                        <th scope="col" class="text-center" style="width: 15%">Outline</th>
                                        <th scope="col" style="width: 45%">Title</th>
                                        <th scope="col" class="text-center" style="width: 15%">Time</th>
                                        <th scope="col" class="text-center" style="width: 15%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lectureOutline[$i] as $lecture)
                                        <tr>
                                            <td class="text-center">
                                                {{ $lecture->is_accepted ? 'Actived' : 'Pending' }}
                                            </td>
                                            <th scope="row" class="text-center">
                                                @if($lecture->is_lecture  == 1)
                                                    {{ __('titles.lecture') . ' ' . $tempLectureCount }}
                                                    @php
                                                        $tempLectureCount++;
                                                    @endphp
                                                @elseif($lecture->is_quiz == 1)
                                                    {{ __('titles.quiz') . ' ' . $tempQuizCount }}
                                                    @php
                                                        $tempQuizCount++;
                                                    @endphp
                                                @endif
                                            </th>
                                            <td>
                                                <a href="{{ '/courses/'. $lecture->course_id . '/lectures/' . $lecture->id }}">{{ $lecture->title }}</a>
                                            </td>
                                            <td class="text-center">{{ $lecture->duration }}</td>
                                            <td class="text-center">
                                                <a href="#" class="text-gray m-r-15 edit-status"><i
                                                            class="ti-pencil"></i></a>
                                                <a href="#" class="text-gray m-r-15 edit-status"><i
                                                            class="ti-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{--                                <tr>--}}
                                    {{--                                    <th scope="row">2</th>--}}
                                    {{--                                    <td>Jacob</td>--}}
                                    {{--                                    <td>Thornton</td>--}}
                                    {{--                                    <td>@fat</td>--}}
                                    {{--                                </tr>--}}
                                    {{--                                <tr>--}}
                                    {{--                                    <th scope="row">3</th>--}}
                                    {{--                                    <td>Larry</td>--}}
                                    {{--                                    <td>the Bird</td>--}}
                                    {{--                                    <td>@twitter</td>--}}
                                    {{--                                </tr>--}}
                                    </tbody>
                                </table>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border bottom">
                            <h4 class="card-title">Student Enrolled Course <b>{{ $selectedCourse->title }}</b> List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-overflow">
                                <table id="dt-opt" class="table table-hover table-xl">
                                    <thead>
                                    <tr>
{{--                                        <th>ID</th>--}}
                                        <th>{{ __('titles.student_id') }}</th>
                                        <th>{{ __('titles.student_name') }}</th>
                                        <th>{{ __('titles.student_enroll_course') }}</th>
                                        <th>{{ __('titles.student_process') }}</th>
                                        {{--                                <th>{{ __('titles.action') }}</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($studentList as $student)
                                        <tr>
{{--                                            <td>#{{ $course->id }}</td>--}}
                                            <td>
                                                <a href="{{ route('users.show', $student->id) }}">{{ $student->id }}</a>
                                            </td>
                                            <td>
                                                <a href="#todo">{{ $student->name }}</a>
                                            </td>
                                            <td>
                                                {{ $student->enrollCourseTime }}
                                            </td>
                                            <td>
                                                {{ $student->progress }}%
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
        </div>
    </div>
    <!-- Content Wrapper END -->
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
