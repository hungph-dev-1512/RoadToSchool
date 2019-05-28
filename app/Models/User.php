<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    const ROLE_ADMIN = 0;
    const ROLE_TEACHER = 1;
    const ROLE_STUDENT = 2;

    public static $roles = [
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_TEACHER => 'Teacher',
        self::ROLE_STUDENT => 'Student',
    ];

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'address',
        'role',
        'is_admin',
        'grade',
        'instructor_rate'
    ];

    const GRADE_0 = 0;
    const GRADE_1 = 1;
    const GRADE_2 = 2;
    const GRADE_3 = 3;
    const GRADE_4 = 4;
    const GRADE_5 = 5;
    const GRADE_6 = 6;
    const GRADE_7 = 7;
    const GRADE_8 = 8;
    const GRADE_9 = 9;
    const GRADE_10 = 10;
    const GRADE_11 = 11;
    const GRADE_12 = 12;
    const GRADE_13 = 13;
    const GRADE_14 = 14;

    public static $grades = [
        self::GRADE_0 => 'Children',
        self::GRADE_1 => 'Grade 1',
        self::GRADE_2 => 'Grade 2',
        self::GRADE_3 => 'Grade 3',
        self::GRADE_4 => 'Grade 4',
        self::GRADE_5 => 'Grade 5',
        self::GRADE_6 => 'Grade 6',
        self::GRADE_7 => 'Grade 7',
        self::GRADE_8 => 'Grade 8',
        self::GRADE_9 => 'Grade 9',
        self::GRADE_10 => 'Grade 10',
        self::GRADE_11 => 'Grade 11',
        self::GRADE_12 => 'Grade 12',
        self::GRADE_13 => 'University and College',
        self::GRADE_14 => 'Out of grade',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * Get the courses for the teacher teaches.
     */
    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }

    public function cart_items()
    {
        return $this->hasMany('App\Models\CartItem');
    }

    public function permission_users()
    {
        return $this->hasMany('App\Models\PermissionUser');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function lecture_comments()
    {
        return $this->hasMany('App\Models\LectureComment');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function discussions()
    {
        return $this->hasMany('App\Models\Discussion');
    }

    public function findUser($id)
    {
        return User::findOrFail($id);
    }

    public function updateUser($data, $id)
    {

        $selectedUser = User::find($id);

        if (isset($data['update_info'])) {
            if (isset($data['cancel_value'])) {
                $data['avatar'] = $selectedUser->avatar;
            } elseif (isset($data['delete_value'])) {
                $data['avatar'] = 'images/avatar/basic-avatar.png';
            } else {
                $file = $data['avatar'];
                $file->store($file->getClientOriginalName());
                $file->move('images/dummy_image', $file->getClientOriginalName());
                $data['avatar'] = 'images/dummy_image/' . $file->getClientOriginalName();
            }
        }

        if (isset($data['update_password'])) {
            if (isset($data['old_password'])) {
                $hasher = app('hash');
                $result = $hasher->check($data['old_password'], $selectedUser->password);
                if (!$result) {
                    return false;
                }
                $data['password'] = Hash::make($data['new_password']);
            }
        }

        return $selectedUser->update($data);
    }

    public function getStudentsCount($idInstructor)
    {
        $coursesInstructor = Course::where('is_accepted', 1)->where('user_id', $idInstructor)->pluck('id');

        return CourseUser::whereIn('course_id', $coursesInstructor)->count();
    }

    public function updateInstructorRate()
    {
        $allInstructors = User::where('role', 1)->get();
        foreach ($allInstructors as $instructor) {
            $avgRate = round(Course::where('is_accepted', 1)->where('user_id', $instructor->id)->avg('course_rate'), 2);
            if ($avgRate === 0) {
                $avgRate = 0;
            }

            $updateResult = $instructor->update(['instructor_rate' => $avgRate]);
            if (!$updateResult) {
                return false;
            }
        }

        return true;
    }


    public static function ordinal($number)
    {
        $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
        if ((($number % 100) >= 11) && (($number % 100) <= 13))
            return $number . 'th';
        else
            return $number . $ends[$number % 10];
    }

    public function createInstructor($data)
    {
        $data['avatar'] = 'images/default_avatar/teacher.jpg';
        $data['role'] = self::ROLE_TEACHER;
        $data['is_admin'] = 0;
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }
}
