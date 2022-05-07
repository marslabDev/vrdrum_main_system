<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLessonLevelsTable extends Migration
{
    public function up()
    {
        Schema::table('lesson_levels', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_category_id')->nullable();
            $table->foreign('lesson_category_id', 'lesson_category_fk_6548238')->references('id')->on('lesson_categories');
        });
    }
}
