<?php

namespace App\Http\Controllers\User;

use App\Models\Course;
use App\Models\Lecture;
use App\Models\Process;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProcessController extends Controller
{
    protected $modelProcess;
    protected $modelLecture;
    protected $modelCourse;

    public function __construct(Process $process, Lecture $lecture, Course $course)
    {
        $this->modelProcess = $process;
        $this->modelLecture = $lecture;
        $this->modelCourse = $course;
    }

    public function changeProcessStatus(Request $request, $lectureId, $userId)
    {
        $selectedProcess = $this->modelProcess->where('lecture_id', $lectureId)->where('user_id', $userId)->first();
        if ($selectedProcess->status == 0) {
            $selectedProcess->update(
                [
                    'status' => 1,
                ]
            );
        }

        $inCourseId = $this->modelLecture->findOrFail($lectureId)->course->id;
        $lastLecture = $this->modelCourse->findOrFail($inCourseId)->lectures->last()->id;
        $responseData['isLastLecture'] = 0;
        if ($lectureId == $lastLecture) {
            $responseData['isLastLecture'] = 1;
        }
        $responseData['nextLecture'] = $this->modelLecture->findOrFail($lectureId + 1);
        $responseData['inCourseId'] = $inCourseId;

//        $currentLectureId = $lectureId + 1;
//        if($lectureId)
//
        return json_encode($responseData);
    }
}
