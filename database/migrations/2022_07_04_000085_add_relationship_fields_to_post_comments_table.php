<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPostCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('post_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_time_post_id')->nullable();
            $table->foreign('lesson_time_post_id', 'lesson_time_post_fk_6873929')->references('id')->on('lesson_time_posts');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6873934')->references('id')->on('users');
        });
    }
}
