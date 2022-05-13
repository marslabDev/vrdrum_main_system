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
            $table->integer('request_user_efk');
            $table->datetime('response_date')->nullable();
            $table->integer('response_user_efk')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
