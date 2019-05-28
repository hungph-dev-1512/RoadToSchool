<?php

namespace App\Http\Controllers\Instructor;

use App\Models\Course;
use App\Models\Lecture;
use App\Models\QuizElement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Embed\Embed;

class LectureController extends Controller
{
    /**
     * The dependency model instance.
     */
    protected $modelCourse;
    protected $modelLecture;
    protected $modelQuizElement;

    /**
     * Create a new controller instance.
     *
     * @param Course $course
     * @param Category $category
     * @return void
     */
    public function __construct(Course $course, Lecture $lecture, QuizElement $quizElement)
    {
        $this->modelCourse = $course;
        $this->modelLecture = $lecture;
        $this->modelQuizElement = $quizElement;
    }

    public function create($courseId)
    {
        $selectedCourse = $this->modelCourse->findOrFail($courseId);
        $allLectures = $selectedCourse->lectures;

        // Get lecture follow week and index
        $maxWeek = 0;
        foreach ($allLectures as $lecture) {
            if ($lecture->week > $maxWeek) {
                $maxWeek = $lecture->week;
            }
        }

        $lectureOutline = [];
        for ($i = 0; $i < $maxWeek; $i++) {
            $lectureOutline[$i] = $this->modelLecture->where('course_id', $courseId)->where('week', ($i + 1))->orderBy('index')->get();
        }

        return view('instructor.lectures.create', compact(
            'selectedCourse',
            'maxWeek',
            'lectureOutline'
        ));
    }

    public function getVideoDuration(Request $request)
    {
        $data = $request->all();

        $embedUrl = Embed::create($data['url']);
        $youtubeTimeFormat = $embedUrl->getProviders()['html']->getBag()->getAll()['duration'];
        $responseData['duration'] = self::covtime($youtubeTimeFormat);
        $responseData['title'] = $embedUrl->title;
        $responseData['description'] = $embedUrl->description;

        return json_encode($responseData);
    }

    public function store(Request $request, $courseId)
    {
        $data = $request->all();
        // Create lecture
        if (array_key_exists('video_link', $data)) {
            if ($data['positionValue'] == 0) {
                // At first
                $data['index'] = 0;
                $data['is_accepted'] = 0;
                $data['week'] = 1;
                $data['course_id'] = $courseId;
                $data['is_lecture'] = 1;
                $data['is_quiz'] = 0;
//            $lectureWeek1List = $this->modelLecture->where('course_id', $courseId)->where('week', 1)->get();
//            foreach($lectureWeek1List as $lecture) {
//                $lecture->update(['index' => ($lecture->index++)]);
//            }
                $result = $this->modelLecture->create($data);
            } else if ($data['positionValue'] == -1) {
                // At last
                $data['index'] = 0;
                $data['is_accepted'] = 0;
                $data['week'] = $data['week']++;
                $data['course_id'] = $courseId;
                $data['is_lecture'] = 1;
                $data['is_quiz'] = 0;

                $result = $this->modelLecture->create($data);
            } else {
                $previousLecture = $this->modelLecture->findOrFail($data['positionValue']);
                $data['index'] = $previousLecture->index++;
                $data['is_accepted'] = 0;
                $data['week'] = $previousLecture->week;
                $data['course_id'] = $courseId;
                $data['is_lecture'] = 1;
                $data['is_quiz'] = 0;

                $result = $this->modelLecture->create($data);
            }

            if ($result) {
                flash(__('messages.create_lecture_successfully'))->success();
            } else {
                flash(__('messages.create_lecture_failed'))->error();
            }
        } else {
            // Create quiz
            if ($data['quizPositionValue'] == 0) {
                // At first
                $data['index'] = 0;
                $data['is_accepted'] = 0;
                $data['week'] = 1;
                $data['course_id'] = $courseId;
                $data['is_lecture'] = 0;
                $data['is_quiz'] = 1;
//            $lectureWeek1List = $this->modelLecture->where('course_id', $courseId)->where('week', 1)->get();
//            foreach($lectureWeek1List as $lecture) {
//                $lecture->update(['index' => ($lecture->index++)]);
//            }
                $createdLecture = $this->modelLecture->create($data);
            } else if ($data['quizPositionValue'] == -1) {
                // At last
                $data['index'] = 0;
                $data['is_accepted'] = 0;
                $data['week'] = $data['week']++;
                $data['course_id'] = $courseId;
                $data['is_lecture'] = 0;
                $data['is_quiz'] = 1;

                $createdLecture = $this->modelLecture->create($data);
            } else {
                $previousLecture = $this->modelLecture->findOrFail($data['quizPositionValue']);
                $data['index'] = $previousLecture->index++;
                $data['is_accepted'] = 0;
                $data['week'] = $previousLecture->week;
                $data['course_id'] = $courseId;
                $data['is_lecture'] = 0;
                $data['is_quiz'] = 1;

                $createdLecture = $this->modelLecture->create($data);
            }

            $questionList = $data['question'];
            foreach ($questionList as $key => $question) {
                if (!is_null($question)) {
                    $dataElement = [];
                    $dataElement['content'] = $question;
                    $dataElement['is_question'] = 1;
                    if (array_key_exists('is_multiple_choice_question_' . ($key + 1), $data)) {
                        $dataElement['is_multiple_choice'] = 1;
                    } else if (array_key_exists('is_single_choice_question_' . ($key + 1), $data) != null) {
                        $dataElement['is_multiple_choice'] = 0;
                    }
                    $dataElement['is_answer'] = 0;
                    $dataElement['lecture_id'] = $createdLecture->id;
                    $createdQuestion = $this->modelQuizElement->create($dataElement);
                    $questionIndex = $key + 1;
                    for ($temp = 1; $temp <= 4; $temp++) {
                        $dataElement = [];
                        $dataElement['content'] = $data['question_' . $questionIndex . '_answer_' . $temp];
                        $dataElement['is_question'] = 0;
                        $dataElement['is_answer'] = 1;
                        $dataElement['question_parent_id'] = $createdQuestion->id;
                        if (array_key_exists('checkbox_question_' . $questionIndex . '_answer_' . $temp, $data)) {
                            $dataElement['is_right_answer'] = 1;
                        } else {
                            $dataElement['is_right_answer'] = 0;
                        }
                        $dataElement['lecture_id'] = $createdLecture->id;
                        $result = $this->modelQuizElement->create($dataElement);
                    }
                }
            }

            if ($result) {
                flash(__('messages.create_quiz_successfully'))->success();
            } else {
                flash(__('messages.create_quiz_failed'))->error();
            }
        }

        return redirect()->route('instructor.courses.show', $courseId);
    }

    function covtime($youtube_time)
    {
        preg_match_all('/(\d+)/', $youtube_time, $parts);

        // Put in zeros if we have less than 3 numbers.
        if (count($parts[0]) == 1) {
            array_unshift($parts[0], "0", "0");
        } elseif (count($parts[0]) == 2) {
            array_unshift($parts[0], "0");
        }

        $sec_init = $parts[0][2];
        $seconds = $sec_init % 60;
        $seconds_overflow = floor($sec_init / 60);

        $min_init = $parts[0][1] + $seconds_overflow;
        $minutes = ($min_init) % 60;
        $minutes_overflow = floor(($min_init) / 60);

        $hours = $parts[0][0] + $minutes_overflow;

        if ($hours != 0)
            return $hours . ':' . $minutes . ':' . $seconds;
        else
            return $minutes . ':' . $seconds;
    }
}
