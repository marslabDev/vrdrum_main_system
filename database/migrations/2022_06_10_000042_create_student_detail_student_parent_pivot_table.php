<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailStudentParentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('student_detail_student_parent', function (Blueprint $table) {
            $table->unsignedBigInteger('student_detail_id');
            $table->foreign('student_detail_id', 'student_detail_id_fk_6762074')->references('id')->on('student_details')->onDelete('cascade');
            $table->unsignedBigInteger('student_parent_id');
            $table->foreign('student_parent_id', 'student_parent_id_fk_6762074')->references('id')->on('student_parents')->onDelete('cascade');
        });
    }
}
