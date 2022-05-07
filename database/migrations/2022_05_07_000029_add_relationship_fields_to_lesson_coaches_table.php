<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLessonCoachesTable extends Migration
{
    public function up()
    {
        Schema::table('lesson_coaches', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_id')->nullable();
            $table->foreign('lesson_id', 'lesson_fk_6548252')->references('id')->on('lessons');
            $table->unsignedBigInteger('coach_id')->nullable();
            $table->foreign('coach_id', 'coach_fk_6548253')->references('id')->on('users');
        });
    }
}
