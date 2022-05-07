<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudentLessonProgressesTable extends Migration
{
    public function up()
    {
        Schema::table('student_lesson_progresses', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_category_id')->nullable();
            $table->foreign('lesson_category_id', 'lesson_category_fk_6548472')->references('id')->on('lesson_categories');
            $table->unsignedBigInteger('student_id')->nullable();
            $table->foreign('student_id', 'student_fk_6548473')->references('id')->on('users');
        });
    }
}
