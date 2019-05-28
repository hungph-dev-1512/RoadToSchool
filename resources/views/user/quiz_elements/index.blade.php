@extends('user.layouts.default')

@section('title')
@endsection

@section('inline_styles')
@endsection

@section('content')
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                    <div class="page-ads box">
                        <h2 class="title-2">{{ $lecture->title }}</h2>
                        <div class="row search-bar mb30 red-bg">
                            <div class="advanced-search">
                                <div class="col-md-6 col-sm-12 search-col">
                                    <span class="hidden-sm hidden-xs"
                                          style="color: white">Course: <strong>{{ $lecture->course->title }}</strong> </span>

                                </div>
                                <div class="col-md-2 col-sm-12 search-col">
                                    <span class="hidden-sm hidden-xs"
                                          style="color: white">Week: <strong>{{ $lecture->week }}</strong> </span>
                                </div>
                                @php
                                    function convertTimeToSecond($time) {
                                        $str_time = $time;
                                        $str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
                                        sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
                                        $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

                                        return $time_seconds;
                                    }
                                @endphp
                                <div class="col-md-2 col-sm-12 search-col">
                                    <span class="hidden-sm hidden-xs"
                                          style="color: white" id="quiz-time"
                                          data-time="{{ convertTimeToSecond($lecture->duration) }}">Time: <strong>{{ $lecture->duration }}</strong> </span>
                                </div>
                                <div class="col-md-2 col-sm-12 search-col">
                                    <button class="btn btn-xs btn-common" id="button-start-quiz"
                                            style="background-color: Tomato"
                                            type="button">Start quiz
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form id="quiz-form" style="display: none;" method="post"
                          action="{{ route('quiz_results.store') }}">
                        @csrf
                        <input type="hidden" id="quiz-result-id" name="quizResultId">
                        @foreach($allQuestion as $key => $question)
                            <br>
                            <div class="form-group">
                                <div class="page-ads box">
                                    <div class="form-group mb30 clearfix">
                                        <label class="control-label" for="textarea">Quiz {{ $key + 1 }}</label>
                                        <p id="question-{{ $question->id }}-content" class="question-content"
                                           data-multi="{{ $question->is_multiple_choice }}">{{ $question->content }}</p>
                                        <div class="form-inline">
                                            @foreach($question->answer as $answer)
                                                <div class="checkbox form-control-static">
                                                    <label><input type="checkbox" data-question="{{ $question->id }}"
                                                                  class="answer-{{ $question->id }}"
                                                                  id="answer-{{ $answer->id }}"
                                                                  data-multi="{{ $question->is_multiple_choice ? '1' : '0'}}"
                                                                  name="answer-{{ $answer->id }}"><span
                                                                class="checkbox-material answer-{{ $question->id }}"></span>{{ $answer->content }}
                                                    </label>
                                                </div>
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if(\Auth::user()->role == 2)
                            <button class="btn btn-common" style="background-color: Tomato; float: right;"
                                    type="submit">
                                Submit
                                for review
                            </button>
                        @else
                            <button class="btn btn-common" id="back-button"
                                    style="background-color: Tomato; float: right;"
                                    type="submit">
                                Back
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('inline_scripts')
    <script>
        $(document).ready(function () {
            $('#button-start-quiz').on('click', function (event) {
                event.preventDefault();
                var questionCount = '{{ $allQuestion->count() }}';
                var lectureId = '{{ $lecture->id }}';
                var userId = '{{ \Auth::user()->id }}';
                var userRole = '{{ \Auth::user()->role }}';

                if (userRole == 2) {
                    // ajax create quiz result and quiz result element
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/quiz_results/storeNewResult',
                        type: 'post',
                        data: {
                            questionCount: questionCount,
                            lectureId: lectureId,
                            userId: userId,
                        },
                        success: function (response) {
                            var responseData = jQuery.parseJSON(response);
                            $('#quiz-result-id').attr('value', responseData);

                            $.ajax({
                                url: '/quiz_element_quiz_result/storeNewRecord',
                                type: 'post',
                                data: {
                                    quizResultId: responseData,
                                }
                            });
                        }
                    });
                }

                $('#button-start-quiz').fadeOut(1000);
                $('#quiz-form').fadeIn(2000);
                var time = $('#quiz-time').data('time');
                var interval = setInterval(function () {
                    time = time - 1;
                    if (time == 300) {
                        $.notify({
                            // options
                            message: '<b>Message from R2S<b>: 5 minutes remaining !',
                        }, {
                            // settings
                            type: 'warning',

                        });
                    }
                    if (time == 60) {
                        $.notify({
                            // options
                            message: '<b>Message from R2S<b>: 1 minutes remaining !',
                        }, {
                            // settings
                            type: 'warning',

                        });
                    }
                    if (time == 0) {
                        clearInterval(interval);
                        $('input:checkbox').attr('disabled', '');
                        $.notify({
                            // options
                            message: '<b>Message from R2S<b>: Time \'s end !\n Starting auto submit ...',
                        }, {
                            // settings
                            type: 'danger',

                        });
                        $('#quiz-time').children().text('Time \'s end, submitting');
                        // ajax save
                    }
                    var hours = Math.floor((time / 3600));
                    var minutes = Math.floor((time - hours * 3600) / 60);
                    var seconds = Math.floor(time - hours * 3600 - minutes * 60);
                    $('#quiz-time').children().text(hours + ':' + minutes + ':' + seconds);
                }, 1000);

                // Update progress
                var lectureId = '{{ $lecture->id }}';
                var userId = '{{ \Auth::user()->id }}';
                $.ajax({
                    url: '/lectures/' + lectureId + '/user/' + userId + '/changeProcessStatus',
                    type: 'post',
                });
            });

            $('.question-content').each(function () {
                if ($(this).data('multi') == 1) {
                    $(this).text($(this).text() + ' Check all that apply.');
                }
            })

            $('input:checkbox').on('change', function () {
                var checkMultipleChoice = $(this).data('multi');
                var selectedId = $(this).attr('id');
                if (checkMultipleChoice == 0) {
                    $questionId = $(this).data('question');
                    $('.answer-' + $questionId).each(function () {
                        if ($(this).attr('id') != selectedId) {
                            $(this).removeAttr('checked');
                        }
                    })
                }
            })

            $('#back-button').on('click', function (event) {
                event.preventDefault();
                history.back();
            })
        });
    </script>
@endsection
