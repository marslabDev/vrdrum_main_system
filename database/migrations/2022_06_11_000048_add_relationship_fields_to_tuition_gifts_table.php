<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTuitionGiftsTable extends Migration
{
    public function up()
    {
        Schema::table('tuition_gifts', function (Blueprint $table) {
            $table->unsignedBigInteger('tuition_package_id')->nullable();
            $table->foreign('tuition_package_id', 'tuition_package_fk_6548095')->references('id')->on('tuition_packages');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6551235')->references('id')->on('users');
        });
    }
}
