<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudentTuitionsTable extends Migration
{
    public function up()
    {
        Schema::table('student_tuitions', function (Blueprint $table) {
            $table->unsignedBigInteger('tuition_package_id')->nullable();
            $table->foreign('tuition_package_id', 'tuition_package_fk_6548209')->references('id')->on('tuition_packages');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6551236')->references('id')->on('users');
        });
    }
}
