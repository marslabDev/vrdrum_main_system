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
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->boolean('is_disabled')->default(0);
            $table->integer('student_efk');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
