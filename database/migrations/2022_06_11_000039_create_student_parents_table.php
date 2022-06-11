<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentParentsTable extends Migration
{
    public function up()
    {
        Schema::create('student_parents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('nationality')->nullable();
            $table->string('relationship');
            $table->string('address')->nullable();
            $table->integer('nric_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
