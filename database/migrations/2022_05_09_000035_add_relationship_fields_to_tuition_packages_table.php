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
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6551234')->references('id')->on('users');
        });
    }
}
