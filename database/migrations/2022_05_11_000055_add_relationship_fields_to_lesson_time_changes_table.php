<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLessonTimeChangesTable extends Migration
{
    public function up()
    {
        Schema::table('lesson_time_changes', function (Blueprint $table) {
            $table->unsignedBigInteger('old_lesson_time_id')->nullable();
            $table->foreign('old_lesson_time_id', 'old_lesson_time_fk_6548392')->references('id')->on('lesson_times');
            $table->unsignedBigInteger('class_room_id')->nullable();
            $table->foreign('class_room_id', 'class_room_fk_6548393')->references('id')->on('class_rooms');
            $table->unsignedBigInteger('lesson_id')->nullable();
            $table->foreign('lesson_id', 'lesson_fk_6548394')->references('id')->on('lessons');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6551243')->references('id')->on('users');
        });
    }
}
