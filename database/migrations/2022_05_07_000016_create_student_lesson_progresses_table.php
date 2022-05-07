<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLessonProgressesTable extends Migration
{
    public function up()
    {
        Schema::create('student_lesson_progresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('progress');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
