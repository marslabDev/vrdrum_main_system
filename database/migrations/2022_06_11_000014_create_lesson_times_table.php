<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTimesTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lesson_code');
            $table->datetime('date_from');
            $table->datetime('date_to');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
