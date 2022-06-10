<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('work_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('student_work_id')->nullable();
            $table->foreign('student_work_id', 'student_work_fk_6596611')->references('id')->on('student_works');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6596616')->references('id')->on('users');
        });
    }
}
