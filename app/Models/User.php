<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    const ROLE_TEACHER = 1;
    const ROLE_STUDENT = 2;
    const GRADE_1 = 1;
    const GRADE_2 = 2;
    const GRADE_3 = 3;
    public static $roles = [
        self::ROLE_TEACHER => 'Teacher',
        self::ROLE_STUDENT => 'Student',
    ];
    public static $grades = [
        self::GRADE_1 => 'Grade 1',
        self::GRADE_2 => 'Grade 2',
        self::GRADE_3 => 'Grade 3',
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
                $data['avatar'] = 'images/avatar/' . $data['avatar'];
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
        $coursesInstructor = Course::where('user_id', $idInstructor)->pluck('id');

        return CourseUser::whereIn('course_id', $coursesInstructor)->count();
    }
}
