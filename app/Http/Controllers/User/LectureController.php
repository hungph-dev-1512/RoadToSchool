<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Discussion;
use App\Models\LectureComment;
use App\Models\Notification;
use App\Models\Process;
use App\Models\QuizElement;
use App\Models\QuizElementzQuizResult;
use App\Models\QuizResult;
use Embed\Embed;
use Illuminate\Http\Request;
use App\Events\GetLectureCommentFromPusherEvent;
use App\Events\GetReplyLectureCommentFromPusherEvent;
use App\Events\GetNotificationFromPusherEvent;

class LectureController extends Controller
{
    // protected $modelLecture;
    protected $modelDiscussion;
    protected $modelLectureComment;
    protected $modelNotification;
    protected $modelProcess;
    protected $modelLecture;
    protected $modelQuizElement;
    protected $modelQuizResult;
    protected $modelQuizElementzQuizResult;

    public function __construct(
        Discussion $discussion,
        LectureComment $lectureComment,
        Notification $notification,
        Process $process,
        Lecture $lecture,
        QuizElement $quizElement,
        QuizResult $quizResult,
        QuizElementzQuizResult $quizElementzQuizResult
    )
    {
        $this->modelDiscussion = $discussion;
        $this->modelLectureComment = $lectureComment;
        $this->modelNotification = $notification;
        $this->modelProcess = $process;
        $this->modelLecture = $lecture;
        $this->modelQuizElement = $quizElement;
        $this->modelQuizResult = $quizResult;
        $this->modelQuizElementzQuizResult = $quizElementzQuizResult;
    }

    public function show($id, $lectureId)
    {
        if ($this->modelLecture::findOrFail($lectureId)->is_quiz == 1) {
            $lecture = $this->modelLecture->findOrFail($lectureId);
            $allQuestion = $this->modelQuizElement->where('lecture_id', $lectureId)->where('is_question', 1)->get();
            foreach ($allQuestion as $question) {
                // TODO xu ly cau hoi nhieu dap an va 1 dap an, pick dap an dung cho phu hop
                $answer = $this->modelQuizElement->where('lecture_id', $lectureId)->where('is_answer', 1)->where('question_parent_id', $question->id)->get();
                $question->answer = $answer;
            }

            return view('user.quiz_elements.index', compact(
                'lecture',
                'allQuestion'
            ));
        } else {
            $link = Lecture::find($lectureId)->video_link;
            $description = Lecture::find($lectureId)->description;
            $teacher = Course::find($id)->user;
            $embed = Embed::create($link);
            $lectures = Course::find($id)->lectures()->where('is_accepted', 1)->get();
            $lectureComments = $this->modelLectureComment->where('lecture_id', $lectureId)->get();

            // Get lecture follow week and index
            $maxWeek = 0;
            foreach ($lectures as $lecture) {
                if ($lecture->week > $maxWeek) {
                    $maxWeek = $lecture->week;
                }
            }

            $lectureOutline = [];
            for ($i = 0; $i < $maxWeek; $i++) {
                $result = $this->modelLecture->where('course_id', $id)->where('is_accepted', 1)->where('week', ($i + 1))->orderBy('index')->get();
                if (!(\Auth::user()->is_admin || \Auth::user()->role == 1)) {
                    foreach ($result as $lecture) {
                        $lecture->status = $this->modelProcess->where('lecture_id', $lecture->id)->where('user_id', \Auth::user()->id)->first()->status;
                    }
                }
                $lectureOutline[$i] = $result;

            }

            if (!(\Auth::user()->is_admin || \Auth::user()->role == 1)) {
                // Get process
                $allLectureCount = $lectures->count();
                $learnedLectureCount = 0;
                foreach ($lectures as $lecture) {
                    $learnStatus = $this->modelProcess->where('lecture_id', $lecture->id)->where('user_id', \Auth::user()->id)->first()->status;
                    if ($learnStatus) {
                        $learnedLectureCount++;
                    }
                }
            }

            // Get all discussions in lecture
            $discussionsList = $this->modelDiscussion->where('lecture_id', $lectureId)->orderBy('created_at')->get();
            // Get all child lecture comment set to collection lecture comment
            foreach ($lectureComments as $lectureComment) {
                $lectureComment->child_comments = $this->modelLectureComment->where('parent_comment', $lectureComment->id)->orderBy('updated_at', 'asc')->get();
            }


            return view('user.lectures.show', compact(
                'embed',
                'lectures',
                'id',
                'description',
                'teacher',
                'lectureId',
                'discussionsList',
                'lectureComments',
                'allLectureCount',
                'learnedLectureCount',
                'maxWeek',
                'lectureOutline'
            ));
        }
    }

    public function postCommentToPusher(Request $request, $lectureId)
    {
        $data = $request->all();
        $data['user_id'] = $data['userId'];
        $data['lecture_id'] = $lectureId;

        $createdLectureComment = $this->modelLectureComment->storeNewLectureComment($data);
        $lectureCommentedUserList = $this->modelLectureComment->where('lecture_id', $lectureId)->whereNull('parent_comment')->where('user_id', '!=', $data['user_id'])->groupBy('user_id')->pluck('user_id');
        // Create Notification
        $createdNotification = $this->modelNotification->createCommentNotification($lectureId, $lectureCommentedUserList, $createdLectureComment, Notification::LECTURE_COMMENT);
        $notificationContent = '<b>' . $createdLectureComment->user->name . '</b>' . ' has commented in lecture ' . Lecture::findOrFail($lectureId)->title . ': ' . $createdLectureComment->content;
        $createNotificationIdList = $this->modelNotification->where('comment_id', $createdLectureComment->id)->pluck('id', 'user_id');

        if ($createdLectureComment && $createdNotification) {
            event(new GetLectureCommentFromPusherEvent($request, $createdLectureComment));
            event(new GetNotificationFromPusherEvent($lectureId, $lectureCommentedUserList, $createdLectureComment, $notificationContent, $createdLectureComment->user->avatar, \Carbon\Carbon::parse($createdLectureComment->created_at)->diffForHumans(), $createNotificationIdList));

            return 200;
        }

        return 500;
    }

    public function postReplyLectureCommentToPusher(Request $request, $lectureId, $parentCommentId)
    {
        $data = $request->all();
        $data['user_id'] = $data['userId'];
        $data['lecture_id'] = $lectureId;
        $data['parent_comment'] = $parentCommentId;

        $createdComment = $this->modelLectureComment->storeNewLectureComment($data);
//        $commentedUserList = $this->modelComment->where('user_id', '!=', $data['user_id'])->where('course_id', $courseId)->where('parent_comment', $parentCommentId)->groupBy('user_id')->pluck('user_id');
//        $createdNotification = $this->modelNotification->createCommentNotification($courseId, $commentedUserList, $createdComment, 'replied');
//        if($createdComment && $createdNotification) {
        if ($createdComment) {
            event(new GetReplyLectureCommentFromPusherEvent($request, $createdComment, $parentCommentId));

            if ($data['firstChildComment'] == 'false') {
                $responseData['prevCommentId'] = $data['prevCommentId'];
                $responseData['parentCommentId'] = $parentCommentId;

                return json_encode($responseData);
            }

            return json_encode($parentCommentId);
        }

        return 500;
    }

    public function showQuizResult($courseId, $lectureId)
    {
        $lecture = $this->modelLecture->findOrFail($lectureId);
        $allQuestion = $this->modelQuizElement->where('lecture_id', $lectureId)->where('is_question', 1)->get();
        $quizResult = $this->modelQuizResult
            ->where('lecture_id', $lectureId)
            ->where('user_id', \Auth::user()->id)
            ->get()
            ->last();
        foreach ($allQuestion as $question) {
            // TODO xu ly cau hoi nhieu dap an va 1 dap an, pick dap an dung cho phu hop
            $answer = $this->modelQuizElement->where('lecture_id', $lectureId)->where('question_parent_id', $question->id)->get();
            $question->answer = $answer;
            $question->trueAnswer = $this->modelQuizElement
                ->where('question_parent_id', $question->id)
                ->where('is_right_answer', 1)
                ->pluck('id')->toArray();
            $userChoice = $this->modelQuizElementzQuizResult
                ->where('quiz_element_id', $question->id)
                ->where('quiz_result_id', $quizResult->id)->get()
                ->last()->user_choice;
            $question->userChoice = explode(',', $userChoice);

            if ($question->trueAnswer == $question->userChoice) {
                $question->checkResult = 1;
            } else {
                $question->checkResult = 0;
            }
        }

        return view('user.quiz_elements.check', compact(
            'lecture',
            'allQuestion',
            'quizResult'
        ));
    }
}
