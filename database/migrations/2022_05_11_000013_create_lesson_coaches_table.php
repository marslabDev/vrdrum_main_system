<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonCoachesTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_coaches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('coach_efk');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
