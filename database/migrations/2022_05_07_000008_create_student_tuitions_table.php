<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTuitionsTable extends Migration
{
    public function up()
    {
        Schema::create('student_tuitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('minute_left', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
