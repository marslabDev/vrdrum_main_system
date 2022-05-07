<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkResourcesTable extends Migration
{
    public function up()
    {
        Schema::table('work_resources', function (Blueprint $table) {
            $table->unsignedBigInteger('student_work_id')->nullable();
            $table->foreign('student_work_id', 'student_work_fk_6551042')->references('id')->on('student_works');
        });
    }
}
