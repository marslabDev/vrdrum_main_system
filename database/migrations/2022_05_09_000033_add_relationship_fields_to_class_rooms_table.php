<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClassRoomsTable extends Migration
{
    public function up()
    {
        Schema::table('class_rooms', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6551244')->references('id')->on('users');
        });
    }
}
