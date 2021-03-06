<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLessonTimesTable extends Migration
{
    public function up()
    {
        Schema::table('lesson_times', function (Blueprint $table) {
            $table->unsignedBigInteger('class_room_id')->nullable();
            $table->foreign('class_room_id', 'class_room_fk_6548342')->references('id')->on('class_rooms');
            $table->unsignedBigInteger('lesson_id')->nullable();
            $table->foreign('lesson_id', 'lesson_fk_6548343')->references('id')->on('lessons');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6551241')->references('id')->on('users');
        });
    }
}
