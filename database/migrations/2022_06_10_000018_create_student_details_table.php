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
            $table->boolean('is_handicapped')->default(0)->nullable();
            $table->string('gender')->nullable();
            $table->string('country')->nullable();
            $table->string('home_address')->nullable();
            $table->string('mail_address');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->integer('postcode')->nullable();
            $table->string('phone')->nullable();
            $table->integer('nric_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
