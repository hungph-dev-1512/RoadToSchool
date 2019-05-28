<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuizElementzQuizResult;
use App\Models\QuizElement;
use App\Models\QuizResult;

class QuizElementzQuizResultController extends Controller
{
    protected $modelQuizElementzQuizResult;
    protected $modelQuizElement;
    protected $modelQuizResult;

    public function __construct(
        QuizElementzQuizResult $quizElementzQuizResult,
        QuizElement $quizElement,
        QuizResult $quizResult
    )
    {
        $this->modelQuizElementzQuizResult = $quizElementzQuizResult;
        $this->modelQuizElement = $quizElement;
        $this->modelQuizResult = $quizResult;
    }

    public function storeNewRecord(Request $request)
    {
        $data = $request->all();
        $quizResultId = $data['quizResultId'];
        $quizResult = $this->modelQuizResult->findOrFail($quizResultId);

        $quizElementArray = $this->modelQuizElement->where('lecture_id', $quizResult->lecture_id)
            ->where('is_question', 1)
            ->get();

        foreach($quizElementArray as $quizElement) {
            $this->modelQuizElementzQuizResult->create([
                'quiz_element_id' => $quizElement->id,
                'quiz_result_id' => $quizResult->id,
            ]);
        }
    }
}
