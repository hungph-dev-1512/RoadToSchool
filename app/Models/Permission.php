<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = [
        'content',
        'group_permission',
    ];

    const ADMIN_GROUP_PERMISSION = 0;
    const INSTRUCTOR_GROUP_PERMISSION = 1;
    const STUDENT_GROUP_PERMISSION = 2;

    public static $permission_group = [
        self::ADMIN_GROUP_PERMISSION => 'Common permission for Admin',
        self::INSTRUCTOR_GROUP_PERMISSION => 'Common permission for Instructor',
        self::STUDENT_GROUP_PERMISSION => 'Common permission for Student',
    ];

    const ADMIN_GROUP = 0;
    const INSTRUCTOR_GROUP = 1;
    const STUDENT_GROUP = 2;

    public static $user_group = [
        self::ADMIN_GROUP => 'Admin Group',
        self::INSTRUCTOR_GROUP => 'Instructor Group',
        self::STUDENT_GROUP => 'Student Group',
    ];

    public function permission_users()
    {
        return $this->hasMany('App\Models\PermissionUser');
    }
}
