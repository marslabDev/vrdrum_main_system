<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->integer('nric_no')->nullable();
            $table->string('gender')->nullable();
            $table->boolean('is_handicapped')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
