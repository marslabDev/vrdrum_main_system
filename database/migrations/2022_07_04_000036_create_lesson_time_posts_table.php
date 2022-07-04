<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTimePostsTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_time_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group');
            $table->string('category');
            $table->string('title');
            $table->longText('desc')->nullable();
            $table->datetime('publish_at');
            $table->datetime('terminate_at')->nullable();
            $table->datetime('start_at')->nullable();
            $table->datetime('end_at')->nullable();
            $table->boolean('required_response')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
