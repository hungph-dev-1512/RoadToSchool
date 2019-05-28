<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    protected $table = 'processes';

    protected $fillable = [
        'status',
        'lecture_id',
        'user_id'
    ];

}
