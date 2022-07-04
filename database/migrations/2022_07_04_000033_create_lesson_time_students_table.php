<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTimeStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_time_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('attended_at')->nullable();
            $table->datetime('leave_at')->nullable();
            $table->datetime('cancel_at')->nullable();
            $table->integer('student_efk');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
