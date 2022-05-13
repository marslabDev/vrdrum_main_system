<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudentWorksTable extends Migration
{
    public function up()
    {
        Schema::table('student_works', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_time_id')->nullable();
            $table->foreign('lesson_time_id', 'lesson_time_fk_6551021')->references('id')->on('lesson_times');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6551230')->references('id')->on('users');
        });
    }
}
