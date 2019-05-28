<?php

namespace App\Http\Controllers\User;

use App\Models\Lecture;
use App\Models\QuizElement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuizResult;
use App\Models\QuizElementzQuizResult;

class QuizResultController extends Controller
{
    protected $modelQuizResult;
    protected $modelQuizElement;
    protected $modelQuizElementQuizResult;
    protected $modelLecture;

    public function __construct(QuizResult $quizResult, QuizElement $quizElement, QuizElementzQuizResult $quizElementzQuizResult, Lecture $lecture)
    {
        $this->modelQuizResult = $quizResult;
        $this->modelQuizElement = $quizElement;
        $this->modelQuizElementQuizResult = $quizElementzQuizResult;
        $this->modelLecture = $lecture;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $quizResultId = $data['quizResultId'];
        $quizResult = $this->modelQuizResult->findOrFail($quizResultId);
        $courseId = $this->modelLecture->findOrFail($quizResult->lecture_id)->course_id;

        $quizElementArray = $this->modelQuizElement->where('lecture_id', $quizResult->lecture_id)
            ->where('is_question', 1)
            ->get();

        $rightAnswer = 0;

        foreach ($quizElementArray as $quizElement) {
            $selected = $this->modelQuizElementQuizResult
                ->where('quiz_element_id', $quizElement->id)
                ->where('quiz_result_id', $quizResultId)
                ->first();

            $answerList = $this->modelQuizElement
                ->where('is_answer', 1)
                ->where('question_parent_id', $quizElement->id)
                ->get();
            $userChoice = [];
            foreach ($answerList as $answer) {
                if (array_key_exists('answer-' . $answer->id, $data)) {
                    array_push($userChoice, $answer->id);
                }
            }
            $userChoiceStr = implode(", ", $userChoice);

            $selected->update(['user_choice' => $userChoiceStr]);

            if ($quizElement->is_multiple_choice == 0) {
                $key = $this->modelQuizElement->where('lecture_id', $quizResult->lecture_id)
                    ->where('is_answer', 1)
                    ->where('is_right_answer', 1)
                    ->first();
                if (array_key_exists('answer-' . $key->id, $data)) {
                    $rightAnswer++;
                }
            } else if ($quizElement->is_multiple_choice == 1) {
                $keyList = $this->modelQuizElement->where('lecture_id', $quizResult->lecture_id)
                    ->where('is_answer', 1)
                    ->where('question_parent_id', $quizElement->id)
                    ->where('is_right_answer', 1)
                    ->pluck('id')
                    ->toArray();
                if ($userChoice == $keyList) {
                    $rightAnswer++;
                }
            }
        }

        $quizResult->update([
            'right_answer_count' => $rightAnswer,
            'wrong_answer_count' => ($quizResult->wrong_answer_count - $rightAnswer)
        ]);

        return redirect()->route('quiz.result', [$courseId, $quizResult->lecture_id]);
    }

    public function storeNewResult(Request $request)
    {
        $data = $request->all();
        $data['lecture_id'] = $data['lectureId'];
        $data['user_id'] = $data['userId'];
        $data['right_answer_count'] = 0;
        $data['wrong_answer_count'] = $data['questionCount'];
        $createdQuizResult = $this->modelQuizResult->create($data);

        return json_encode($createdQuizResult->id);
    }
}
