<?php

namespace App\Http\Middleware;

use App\Models\Lecture;
use App\Models\QuizResult;
use Closure;
use App\Models\CourseUser;

class CheckUserToLecture
{
    protected $modelCourseUser;
    protected $modelLecture;
    protected $modelQuizResult;

    public function __construct(CourseUser $courseUser, Lecture $lecture, QuizResult $quizResult)
    {
        $this->modelCourseUser = $courseUser;
        $this->modelLecture = $lecture;
        $this->modelQuizResult = $quizResult;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()->is_admin || $request->user()->role == 1) {
            return $next($request);
        }
        $routeParams = $request->route()->parameters();
        $courseId = $routeParams['id'];
        if ($this->modelCourseUser->where('course_id', $courseId)->where('user_id', $request->user()->id)->get()->isEmpty()) {
            return abort(403, "Sorry ! No permissions here");
        }

        if($request->route()->getName() != 'quiz.result' && $this->modelLecture->findOrFail($routeParams['lectureId'])->is_quiz) {
            $check = $this->modelQuizResult->where('lecture_id', $routeParams['lectureId'])->where('user_id',$request->user()->id)->first();
            if($check) {
                return abort(404, "You did this quiz !!!");
            }
        }

        return $next($request);
    }
}
