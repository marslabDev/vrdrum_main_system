<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLessonTimeCoachesTable extends Migration
{
    public function up()
    {
        Schema::table('lesson_time_coaches', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_time_id')->nullable();
            $table->foreign('lesson_time_id', 'lesson_time_fk_6548349')->references('id')->on('lesson_times');
            $table->unsignedBigInteger('coach_id')->nullable();
            $table->foreign('coach_id', 'coach_fk_6548350')->references('id')->on('users');
        });
    }
}
