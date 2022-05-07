<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLessonsTable extends Migration
{
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_level_id')->nullable();
            $table->foreign('lesson_level_id', 'lesson_level_fk_6548246')->references('id')->on('lesson_levels');
        });
    }
}
