<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizElementQuizResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_element_quiz_result', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_choice')->nullable();
            $table->unsignedInteger('quiz_element_id');
            $table->foreign('quiz_element_id')->references('id')->on('quiz_elements')->onDelete('cascade');
            $table->unsignedInteger('quiz_result_id');
            $table->foreign('quiz_result_id')->references('id')->on('quiz_results')->onDelete('cascade');
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
        Schema::dropIfExists('quiz_element_quiz_result');
    }
}
