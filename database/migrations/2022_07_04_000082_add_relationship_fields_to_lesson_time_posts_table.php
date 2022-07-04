<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLessonTimePostsTable extends Migration
{
    public function up()
    {
        Schema::table('lesson_time_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_time_id')->nullable();
            $table->foreign('lesson_time_id', 'lesson_time_fk_6873818')->references('id')->on('lesson_times');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6873816')->references('id')->on('users');
        });
    }
}
