<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Course;

class UserController extends Controller
{
    /**
     * The user model instance.
     */
    protected $modelUser;

    /**
     * Create a new controller instance.
     *
     * @param User $users
     * @return void
     */
    public function __construct(User $users)
    {
        $this->modelUser = $users;
    }

    /**
     * Show detail user
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $selectedUser = $this->modelUser->findUser($id);

        // Get difftime from last login to now.
        // $diffTime = \Carbon\Carbon::parse($selectedUser->last_login)->diffForHumans();
        // Get all province from database.
        $selectProvince = \App\Models\Province::all()->pluck('name', 'id');

        return view('user.users.show', compact(
            'selectedUser',
            'diffTime',
            'selectProvince'
        ));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->all();
        $result = $this->modelUser->updateUser($data, $id);

        if ($result) {
            flash(__('messages.update_successfully'))->success();
        } else {
            flash(__('messages.update_failed'))->error();
        }

        return redirect()->route('users.show', $id);
    }

    public function getInstructorInfo($id)
    {
        $selectedInstructor = $this->modelUser->findUser($id);
        $instructorStudentsCount = $this->modelUser->getStudentsCount($id);
        $instructorCoursesCount = Course::where('is_accepted', 1)->where('user_id', $id)->get()->count();
        $instructorRating = round(Course::where('is_accepted', 1)->where('user_id', $id)->avg('course_rate'), 2);
        $bestCoursesInstructor = Course::where('is_accepted', 1)->where('user_id', $id)->orderBy('seller', 'desc')->limit(5)->get();

        return view('user.users.instructor_info', compact(
            'selectedInstructor',
            'instructorStudentsCount',
            'instructorCoursesCount',
            'instructorRating',
            'bestCoursesInstructor'
        ));
    }
}
