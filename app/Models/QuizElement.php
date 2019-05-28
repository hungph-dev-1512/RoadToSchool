<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizElement extends Model
{
    protected $table = 'quiz_elements';

    protected $fillable = [
        'content',
        'is_question',
        'is_multiple_choice',
        'is_answer',
        'question_parent_id',
        'is_right_answer',
        'lecture_id',
    ];
}
