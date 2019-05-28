@extends('admin.layouts.default')

@section('title')
    Create a lecture
@endsection

@section('inline_styles')
    <link rel="stylesheet"
          href="{{ asset('assets/admin/vendor/datatables/media/css/dataTables.bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/custom/hide-am-pm.css') }}"/>
@endsection

@section('content')
    <!-- Content Wrapper START -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="page-header">
                <h2 class="header-title">Create a lecture</h2>
                <div class="header-sub-title">
                    <nav class="breadcrumb breadcrumb-dash">
                        <a href="{{ route('instructor.dashboard') }}" class="breadcrumb-item"><i
                                    class="ti-home p-r-5"></i>Home</a>
                        <a class="breadcrumb-item"
                           href="{{ route('instructor.courses.show', $selectedCourse->id) }}">{{ $selectedCourse->title }}</a>
                        <span class="breadcrumb-item active">Create a lecture</span>
                    </nav>
                </div>
            </div>
            <div class="card">
                <div class="card-header border bottom">
                    <h4 class="card-title">Create a lecture in course {{ $selectedCourse->title }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <p style="color: red; display: none" id="error-url">Error: Video URL is valid. Please try
                                another !</p>
                            <div class="form-group">
                                <div class="m-b-10">
                                    <label class="control-label">Choose a lecture type</label>
                                </div>
                                <div class="radio d-inline m-r-15">
                                    <input id="basicFormRadio1" name="lecture_type" type="radio">
                                    <label for="basicFormRadio1">Video Lecture</label>
                                </div>
                                <div class="radio d-inline m-r-15">
                                    <input id="basicFormRadio2" name="lecture_type" type="radio">
                                    <label for="basicFormRadio2">Quiz</label>
                                </div>
                            </div>
                            <form role="form" style="display: none" id="lecture-form" method="post"
                                  action="{{ route('instructor.courses.lectures.store', $selectedCourse->id) }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Video URL *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="input-youtube-url"
                                               name="video_link"
                                               placeholder="Youtube video URL ...">
                                        <br>
                                        <button class="btn btn-gradient-success pull-right" id="button-get-duration"
                                                style="display: none;">Apply Youtube URL and Get Information
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Title *</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="input-video-title" class="form-control"
                                               name="title"
                                               placeholder="Type lecture title ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="input-video-description" rows="4"
                                                  name="description"
                                                  placeholder="Type lecture description ..."></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Duration *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="input-video-duration"
                                               name="duration" placeholder="Auto get video duration" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Week *</label>
                                    <select class="form-control col-sm-4" id="select-week" name="week">
                                        <option value="" disabled selected>Select a week...</option>
                                        <option value="0"> Add lecture at first</option>
                                        @for($j = 1; $j <= $maxWeek + 1; $j++)
                                            <option value="{{ $j }}">
                                                Week {{ $j }} {{ $j == $maxWeek + 1 ? '(Add new)' : '' }}</option>
                                        @endfor
                                    </select>
                                    <button class="btn btn-gradient-success col-sm-4" id="button-get-week-outline"
                                            style="display: none; margin-left: 30px">
                                    </button>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Lecture Position *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="input-lecture-position"
                                               name="inputMaxValue"
                                               placeholder="Auto get lecture position" disabled="">
                                    </div>
                                </div>
                                @for($i = 0; $i < $maxWeek; $i++)
                                    <div class="table-overflow" id="table-outline-week-{{ $i + 1 }}"
                                         style="display: none">
                                        <h3>Week {{ $i + 1 }}</h3>
                                        @php
                                            $tempLectureCount = 1;
                                            $tempQuizCount = 1;
                                        @endphp
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="text-center" style="width: 15%">Outline</th>
                                                <th scope="col" style="width: 55%">Title</th>
                                                <th scope="col" class="text-center" style="width: 15%">Time</th>
                                                <th scope="col" class="text-center" style="width: 15%">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($i == $maxWeek)
                                                <tr>
                                                    <td> Add new lecture here</td>
                                                </tr>
                                            @endif
                                            @foreach($lectureOutline[$i] as $lecture)
                                                <tr>
                                                    <th scope="row" class="text-center">
                                                        <p>
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
                                                        </p>
                                                    </th>
                                                    <td>{{ $lecture->title }}</td>
                                                    <td class="text-center">{{ $lecture->duration }}</td>
                                                    <td class="text-center">
                                                        <a href="#" class="text-gray m-r-15 button-select-selection"
                                                           data-week="{{ $i + 1 }}" data-lecture="{{ $lecture->id }}"><i
                                                                    class="ti-arrow-down"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endfor
                                <input type="hidden" id="input-position-value" name="positionValue">
                                <button class="btn btn-gradient-success" type="submit">Submit</button>
                            </form>
                            <form role="form" style="display: none" id="quiz-form" role="form" style="display: none"
                                  id="lecture-form" method="post"
                                  action="{{ route('instructor.courses.lectures.store', $selectedCourse->id) }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Title *</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="quiz-input-video-title" class="form-control"
                                               name="title"
                                               placeholder="Type quiz title ...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="quiz-input-video-description" rows="4"
                                                  name="description"
                                                  placeholder="Type quiz description ..."></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Time(HH:MM:SS) *</label>
                                    <div class="col-sm-2">
                                        <input class="form-control" type='time' name="duration" min='00:00:00'
                                               max='02:30:00' step="1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Week *</label>
                                    <select class="form-control col-sm-4" id="quiz-select-week" name="week">
                                        <option value="" disabled selected>Select a week...</option>
                                        <option value="0"> Add quiz at first</option>
                                        @for($j = 1; $j <= $maxWeek + 1; $j++)
                                            <option value="{{ $j }}">
                                                Week {{ $j }} {{ $j == $maxWeek + 1 ? '(Add new)' : '' }}</option>
                                        @endfor
                                    </select>
                                    <button class="btn btn-gradient-success col-sm-4" id="quiz-button-get-week-outline"
                                            style="display: none; margin-left: 30px">
                                    </button>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Lecture Position *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="quiz-input-lecture-position"
                                               name="position_value"
                                               placeholder="Auto get quiz position" disabled="">
                                    </div>
                                </div>
                                @for($i = 0; $i < $maxWeek; $i++)
                                    <div class="table-overflow" id="quiz-table-outline-week-{{ $i + 1 }}"
                                         style="display: none">
                                        <h3>Week {{ $i + 1 }}</h3>
                                        @php
                                            $tempLectureCount = 1;
                                            $tempQuizCount = 1;
                                        @endphp
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="text-center" style="width: 15%">Outline</th>
                                                <th scope="col" style="width: 55%">Title</th>
                                                <th scope="col" class="text-center" style="width: 15%">Time</th>
                                                <th scope="col" class="text-center" style="width: 15%">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($i == $maxWeek)
                                                <tr>
                                                    <td> Add new lecture here</td>
                                                </tr>
                                            @endif
                                            @foreach($lectureOutline[$i] as $lecture)
                                                <tr>
                                                    <th scope="row" class="text-center">
                                                        <p>
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
                                                        </p>
                                                    </th>
                                                    <td>{{ $lecture->title }}</td>
                                                    <td class="text-center">{{ $lecture->duration }}</td>
                                                    <td class="text-center">
                                                        <a href="#"
                                                           class="text-gray m-r-15 quiz-button-select-selection"
                                                           data-week="{{ $i + 1 }}"
                                                           data-lecture="{{ $lecture->id }}"><i
                                                                    class="ti-arrow-down"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endfor
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label control-label">Question Count *</label>
                                    <select class="form-control col-sm-1" id="quiz-input-question-count">
                                        @for($j = 1; $j <= 10; $j++)
                                            <option value="{{ $j }}"> {{ $j }} </option>
                                        @endfor
                                    </select>
                                    <button class="btn btn-gradient-success col-sm-4" id="quiz-button-get-question-form"
                                            style="display: none; margin-left: 30px"> Get Form Question
                                    </button>
                                </div>
                                @for($temp=1;$temp<=10;$temp++)
                                    <div class="form-group row" id="select-question-{{ $temp }}-type"
                                         style="display: none;">
                                        <label class="col-sm-3 col-form-label control-label">Question {{ $temp }} Type
                                            *</label>
                                        <div class="col-sm-9">
                                            <div class="radio">
                                                <input class="radio-single-choice radio-check-multi" id="radio-single-choice-{{ $temp }}"
                                                       name="is_single_choice_question_{{ $temp }}" type="radio"
                                                       data-question="{{ $temp }}">
                                                <label for="radio-single-choice-{{ $temp }}">Single Choice</label>
                                            </div>
                                            <div class="radio">
                                                <input class="radio-multi-choice radio-check-multi" id="radio-multi-choice-{{ $temp }}"
                                                       name="is_multiple_choice_question_{{ $temp }}" type="radio"
                                                       data-question="{{ $temp }}">
                                                <label for="radio-multi-choice-{{ $temp }}">Multiple Choice</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="input-question-{{ $temp }}-content"
                                         style="display: none;">
                                        <label class="col-sm-3 col-form-label control-label">Question {{ $temp }}
                                            Content *</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" rows=2 class="form-control"
                                                      name="question[]"
                                                      placeholder="Type the question ..."></textarea>
                                        </div>
                                    </div>
                                    @for($k=1; $k<=4; $k++)
                                        <div class="form-group row answer-question-{{ $temp }}" style="display: none;">
                                            <label class="col-sm-3 col-form-label control-label">Answer {{ $k }}</label>
                                            <div class="col-sm-9 input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <div class="checkbox ">
                                                            <input class="input-checkbox checkbox-answer-question-{{ $temp }}"
                                                                   id="question-{{ $temp }}-answer-{{ $k }}"
                                                                   name="checkbox_question_{{ $temp }}_answer_{{ $k }}"
                                                                   data-question="{{ $temp }}" data-answer="{{ $k }}"
                                                                   type="checkbox">
                                                            <label class="m-r-0"
                                                                   for="question-{{ $temp }}-answer-{{ $k }}"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <textarea type="text" rows="2" name="question_{{ $temp }}_answer_{{ $k }}" class="form-control"
                                                          placeholder="Write answer content and check to right answer ..."></textarea>
                                            </div>
                                        </div>
                                    @endfor
                                @endfor
                                <input type="hidden" id="quiz-input-position-value" name="quizPositionValue">
                                <button class="btn btn-gradient-success" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper END -->
@endsection

@section('inline_scripts')
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/media/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/tables/data-table.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('input[name=lecture_type]').on('change', function () {
                if ($("#basicFormRadio1").is(":checked")) {
                    $('#lecture-form').fadeIn(300);
                    $('#quiz-form').fadeOut(300);
                }

                if ($("#basicFormRadio2").is(":checked")) {
                    $('#lecture-form').fadeOut(300);
                    $('#quiz-form').fadeIn(300);
                }

                $('#input-youtube-url').on('input', function (e) {
                    $('#button-get-duration').fadeIn(300);
                    $('#error-url').hide();
                });

                // Get Youtube duration
                $('#button-get-duration').on('click', function (event) {
                    event.preventDefault();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/youtube/getVideoDuration',
                        type: 'post',
                        data: {
                            url: $('#input-youtube-url').val()
                        },
                        success: function (response) {
                            var responseData = jQuery.parseJSON(response);
                            $('#button-get-duration').hide();
                            $('#input-video-duration').val(responseData.duration);
                            $('#input-video-title').val(responseData.title);
                            $('#input-video-description').val(responseData.description);
                        },
                        error: function () {
                            $('#error-url').fadeIn(300);
                            $('#button-get-duration').hide();
                            $('#input-youtube-url').val('');
                        }
                    });
                })

                $('#select-week').on('change', function () {
                    var maxWeek = '{{ $maxWeek }}';
                    if ($(this).val() == 0) {
                        $('#button-get-week-outline').text('Apply and Add New Lecture at First');
                    } else if ($(this).val() == parseInt(maxWeek) + 1) {
                        $('#button-get-week-outline').text('Apply and Add New Lecture to Week ' + $(this).val());
                    } else {
                        $('#button-get-week-outline').text('Apply and Get Week ' + $(this).val() + ' Outline');
                    }
                    $('#button-get-week-outline').fadeIn(300);
                })

                $('#button-get-week-outline').on('click', function (event) {
                    event.preventDefault();
                    var maxWeek = '{{ $maxWeek }}';
                    $('.table-overflow').fadeOut(300);
                    $('#table-outline-week-' + $('#select-week').val()).fadeIn(300);
                    var selectedValue = $('#select-week').val();
                    if (selectedValue == 0) {
                        $('#input-lecture-position').val('Before lecture 1 of week 1');
                        $('#input-position-value').val(0);
                    } else if (selectedValue == parseInt(maxWeek) + 1) {
                        $('#input-lecture-position').val('Add new to week ' + (parseInt(maxWeek) + 1));
                        $('#input-position-value').val(-1);
                    }
                    $('#button-get-week-outline').fadeOut(300);
                })

                $('#quiz-select-week').on('change', function () {
                    var maxWeek = '{{ $maxWeek }}';
                    if ($(this).val() == 0) {
                        $('#quiz-button-get-week-outline').text('Apply and Add New Lecture at First');
                    } else if ($(this).val() == parseInt(maxWeek) + 1) {
                        $('#quiz-button-get-week-outline').text('Apply and Add New Lecture to Week ' + $(this).val());
                    } else {
                        $('#quiz-button-get-week-outline').text('Apply and Get Week ' + $(this).val() + ' Outline');
                    }
                    $('#quiz-button-get-week-outline').fadeIn(300);
                })

                $('#quiz-button-get-week-outline').on('click', function (event) {
                    event.preventDefault();
                    var maxWeek = '{{ $maxWeek }}';
                    $('.table-overflow').fadeOut(300);
                    $('#quiz-table-outline-week-' + $('#quiz-select-week').val()).fadeIn(300);
                    var selectedValue = $('#quiz-select-week').val();
                    if (selectedValue == 0) {
                        $('#quiz-input-lecture-position').val('Before lecture 1 of week 1');
                        $('#quiz-input-position-value').val(0);
                    } else if (selectedValue == parseInt(maxWeek) + 1) {
                        $('#quiz-input-lecture-position').val('Add new to week ' + (parseInt(maxWeek) + 1));
                        $('#quiz-input-position-value').val(-1);
                    }
                    $('#quiz-button-get-week-outline').fadeOut(300);
                })

                $('.button-select-selection').on('click', function (event) {
                    event.preventDefault();
                    var position = $(this).parent().parent().children().first().text().trim().toLowerCase();
                    $('#input-lecture-position').val('Add new to week ' + $(this).data('week') + ' after ' + position);
                    $('#input-position-value').val($(this).data('lecture'));
                })

                $('.quiz-button-select-selection').on('click', function (event) {
                    event.preventDefault();
                    var position = $(this).parent().parent().children().first().text().trim().toLowerCase();
                    $('#quiz-input-lecture-position').val('Add new to week ' + $(this).data('week') + ' after ' + position);
                    $('#quiz-input-position-value').val($(this).data('lecture'));
                })


                $('#quiz-input-question-count').on('change', function () {
                    $('#quiz-button-get-question-form').fadeIn(300);
                })

                $('#quiz-button-get-question-form').on('click', function (event) {
                    event.preventDefault();
                    var questionCount = $('#quiz-input-question-count').val();
                    for (var temp = 1; temp <= questionCount; temp++) {
                        $('#select-question-' + temp + '-type').fadeIn(300);
                    }
                    $(this).fadeOut(300);
                })

                $('.radio-check-multi').on('change', function () {
                    var questionNumber = $(this).data('question');
                    $('#input-question-' + questionNumber + '-content').fadeIn(300);
                    $('.answer-question-' + questionNumber).fadeIn(300);
                    $('.checkbox-answer-question-' + questionNumber).prop('checked', false);
                    ;
                    // if($('.radio-single-choice').is(":checked")) {
                    //
                    // }
                })

                $('.input-checkbox').on('click', function () {
                    var questionId = $(this).data('question');
                    if ($('#radio-single-choice-' + questionId).is(':checked')) {
                        var selectedId = $(this).prop('id');
                        if ($('.checkbox-answer-question-' + questionId).is(':checked')) {
                            var answerListElement = $('.checkbox-answer-question-' + questionId);
                            answerListElement.each(function () {
                                if ($(this).prop('id') != selectedId) {
                                    $(this).prop('checked', false);
                                }
                            })
                        }
                    }
                })
            })
        })
    </script>
@endsection