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
                                <div class="col-md-3 col-sm-12 search-col">
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
                                <div class="col-md-3 col-sm-12 search-col">
                                    <span class="hidden-sm hidden-xs"
                                          style="color: white">Your result: <strong>{{ $quizResult->right_answer_count . '/' . ($quizResult->right_answer_count + $quizResult->wrong_answer_count) }}</strong> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="quiz-result-id" name="quizResultId">
                    @foreach($allQuestion as $key => $question)
                        <br>
                        <div class="form-group">
                            <div class="page-ads box">
                                <div class="form-group mb30 clearfix" style="padding: 15px 30px 15px 30px">
                                    <label class="control-label" for="textarea">
                                        <h3>
                                            Quiz {{ $key + 1 }} [{!! $question->checkResult ? '<span style="color:green"><i class="fa fa-check" aria-hidden="true"></i> True</span>' : '<span style="color:red"><i class="fa fa-times" aria-hidden="true"></i> False</span>' !!}]
                                        </h3>
                                    </label>
                                    <p id="question-{{ $question->id }}-content" class="question-content"
                                       data-multi="{{ $question->is_multiple_choice }}">{{ $question->content }}</p>
                                    <div class="form-inline">
                                        @foreach($question->answer as $answer)
                                            <div class="checkbox form-control-static">
                                                <label
                                                        style="@if(in_array($answer->id, $question->trueAnswer)) {{ 'color:green' }} @elseif(!empty($question->userChoice) && in_array($answer->id, $question->userChoice)) {{ 'color:red' }} @endif">
                                                    <input type="checkbox" {{ (in_array($answer->id, $question->trueAnswer) || (!empty($question->userChoice) && in_array($answer->id, $question->userChoice))) ? 'checked' : '' }}>
                                                    <span class="checkbox-material answer-{{ $question->id }}">
                                                    </span>{{ $answer->content }}
                                                </label>
                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                    {!! !$question->userChoice[0] ? '<h4><i class="fa fa-times" aria-hidden="true"></i> <i>You did not choose the answer to this question</i></h4>' : '' !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </form>
                        <a class="btn btn-common"
                                style="background-color: Tomato; float: right;"
                                href="{{ route('courses.show', $lecture->course_id) }}#course-{{ $lecture->course_id }}-outline">
                            Back To Course
                        </a>
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
        });
    </script>
@endsection
