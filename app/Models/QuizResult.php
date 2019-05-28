<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $table = 'quiz_results';
    protected $fillable = [
        'right_answer_count',
        'wrong_answer_count',
        'lecture_id',
        'user_id'
    ];
}
