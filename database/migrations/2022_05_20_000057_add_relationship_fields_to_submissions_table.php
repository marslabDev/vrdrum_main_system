<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('student_work_id')->nullable();
            $table->foreign('student_work_id', 'student_work_fk_6551031')->references('id')->on('student_works');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6551231')->references('id')->on('users');
        });
    }
}
