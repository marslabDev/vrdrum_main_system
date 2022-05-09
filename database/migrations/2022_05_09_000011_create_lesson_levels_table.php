<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonLevelsTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_levels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('level');
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
