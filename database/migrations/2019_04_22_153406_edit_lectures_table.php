<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->longText('description', 50000)->nullable()->change();
            $table->string('video_link')->nullable()->change();
            $table->time('duration')->change();
            $table->integer('week')->after('duration');
            $table->integer('index')->after('week');
            $table->tinyInteger('is_lecture')->after('index')->nullable();
            $table->tinyInteger('is_quiz')->after('is_lecture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->longText('description')->change();
            $table->string('video_link')->change();
            $table->time('duration')->change();
            $table->dropColumn('week');
            $table->dropColumn('index');
            $table->dropColumn('is_lecture');
            $table->dropColumn('is_quiz');
        });
    }
}
