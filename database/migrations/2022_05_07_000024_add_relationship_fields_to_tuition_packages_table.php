<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTuitionPackagesTable extends Migration
{
    public function up()
    {
        Schema::table('tuition_packages', function (Blueprint $table) {
            $table->unsignedBigInteger('lesson_category_id')->nullable();
            $table->foreign('lesson_category_id', 'lesson_category_fk_6548078')->references('id')->on('lesson_categories');
        });
    }
}
