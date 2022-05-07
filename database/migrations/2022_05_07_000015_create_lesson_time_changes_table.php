<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonTimeChangesTable extends Migration
{
    public function up()
    {
        Schema::create('lesson_time_changes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('date_from');
            $table->datetime('date_to');
            $table->string('status')->nullable();
            $table->datetime('request_date')->nullable();
            $table->datetime('response_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
