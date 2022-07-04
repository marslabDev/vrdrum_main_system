<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToStudentDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('student_details', function (Blueprint $table) {
            $table->unsignedBigInteger('home_address_id')->nullable();
            $table->foreign('home_address_id', 'home_address_fk_6774093')->references('id')->on('addresses');
            $table->unsignedBigInteger('mail_address_id')->nullable();
            $table->foreign('mail_address_id', 'mail_address_fk_6774094')->references('id')->on('addresses');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6767709')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6551228')->references('id')->on('users');
        });
    }
}
