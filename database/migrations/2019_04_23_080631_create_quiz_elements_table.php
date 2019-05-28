<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_elements', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('content', 50000);
            $table->tinyInteger('is_question');
            $table->tinyInteger('is_multiple_choice')->nullable();
            $table->tinyInteger('is_answer');
            $table->unsignedInteger('question_parent_id')->nullable();
            $table->tinyInteger('is_right_answer')->nullable();
            $table->unsignedInteger('lecture_id');
            $table->foreign('lecture_id')->references('id')->on('lectures')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_elements');
    }
}
