<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no_of_class');
            $table->string('name');
            $table->string('syllabus')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
