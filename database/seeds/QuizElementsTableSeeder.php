<?php

use Illuminate\Database\Seeder;
use App\Models\QuizElement;

class QuizElementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('quiz_elements')->truncate();
        Schema::enableForeignKeyConstraints();

        // question 1
        QuizElement::create([
            'content' => 'A computer program is said to learn from experience E with respect to some task T and some performance measure P if its performance on T, as measured by P, improves with experience E. Suppose we feed a learning algorithm a lot of historical weather data, and have it learn to predict weather. What would be a reasonable choice for P?',
            'is_question' => 1,
            'is_multiple_choice' => 0,
            'is_answer' => 0,
            'lecture_id' => 6,
        ]);

        QuizElement::create([
            'content' => 'The probability of it correctly predicting a future date weather.',
            'is_question' => 0,
            'is_answer' => 1,
            'question_parent_id' => 1,
            'is_right_answer' => 1,
            'lecture_id' => 6,
        ]);

        QuizElement::create([
            'content' => 'The weather prediction task.',
            'is_question' => 0,
            'is_answer' => 1,
            'question_parent_id' => 1,
            'is_right_answer' => 0,
            'lecture_id' => 6,
        ]);

        QuizElement::create([
            'content' => 'The process of the algorithm examining a large amount of historical weather data.',
            'is_question' => 0,
            'is_answer' => 1,
            'question_parent_id' => 1,
            'is_right_answer' => 0,
            'lecture_id' => 6,
        ]);

        QuizElement::create([
            'content' => 'None of these.',
            'is_question' => 0,
            'is_answer' => 1,
            'question_parent_id' => 1,
            'is_right_answer' => 0,
            'lecture_id' => 6,
        ]);

        // question 2
        QuizElement::create([
            'content' => 'Which of these is a reasonable definition of machine learning?',
            'is_question' => 1,
            'is_multiple_choice' => 0,
            'is_answer' => 0,
            'lecture_id' => 6,
        ]);

        QuizElement::create([
            'content' => 'Machine learning is the field of study that gives computers the ability to learn without being explicitly programmed.',
            'is_question' => 0,
            'is_answer' => 1,
            'question_parent_id' => 6,
            'is_right_answer' => 1,
            'lecture_id' => 6,
        ]);

        QuizElement::create([
            'content' => 'Machine learning is the science of programming computers.',
            'is_question' => 0,
            'is_answer' => 1,
            'question_parent_id' => 6,
            'is_right_answer' => 0,
            'lecture_id' => 6,
        ]);

        QuizElement::create([
            'content' => 'Machine learning means from labeled data.',
            'is_question' => 0,
            'is_answer' => 1,
            'question_parent_id' => 6,
            'is_right_answer' => 0,
            'lecture_id' => 6,
        ]);

        QuizElement::create([
            'content' => 'Machine learning is the field of allowing robots to act intelligently.',
            'is_question' => 0,
            'is_answer' => 1,
            'question_parent_id' => 6,
            'is_right_answer' => 0,
            'lecture_id' => 6,
        ]);

//        QuizElement::create([
//            'content' => ,
//            'is_question' => ,
//            'is_multiple_choice' => ,
//            'is_answer' => ,
//            'question_parent_id' => ,
//            'is_right_answer' => ,
//            'lecture_id' => ,
//        ]);
    }
}