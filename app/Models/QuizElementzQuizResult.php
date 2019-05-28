<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizElementzQuizResult extends Model
{
    protected $table = 'quiz_element_quiz_result';
    protected $fillable = [
        'user_choice',
        'quiz_element_id',
        'quiz_result_id',
    ];
}
