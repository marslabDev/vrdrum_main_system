<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentWorksTable extends Migration
{
    public function up()
    {
        Schema::create('student_works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category')->nullable();
            $table->string('title');
            $table->string('desc')->nullable();
            $table->datetime('start_at')->nullable();
            $table->datetime('end_at')->nullable();
            $table->float('time_given_minute', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
