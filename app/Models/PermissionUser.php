<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    protected $table = 'permission_user';

    public function permission()
    {
        return $this->belongsTo('App\Models\Permission');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    protected $fillable = [
        'permission_id',
        'user_id',
    ];
}
