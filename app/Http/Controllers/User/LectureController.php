<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecture;
use Embed\Embed;

class LectureController extends Controller
{
    // protected $modelLecture;

    // public function __construct(Lecture $lecture)
    // {
    //     $this->modelLecture = $lecture;
    // }

    public function show($id, $lectureId)
    {
        $link = Lecture::find($lectureId)->video_link;
        $description = Lecture::find($lectureId)->description;
        $teacher = Course::find($id)->user;
        $embed = Embed::create($link);
        $lectures = Course::find($id)->lectures;

        return view('user.lectures.show', compact(
            'embed',
            'lectures',
            'id',
            'description',
            'teacher',
            'lectureId'
        ));
    }
}
