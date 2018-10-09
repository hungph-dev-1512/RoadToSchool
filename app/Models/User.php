<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    const ROLE_TEACHER = 1;
    const ROLE_STUDENT = 2;
    
    public static $roles = [
        self::ROLE_TEACHER => 'Teacher',
        self::ROLE_STUDENT => 'Student',
    ];
}
