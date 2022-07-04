<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPostContentSubmitsTable extends Migration
{
    public function up()
    {
        Schema::table('post_content_submits', function (Blueprint $table) {
            $table->unsignedBigInteger('post_content_id')->nullable();
            $table->foreign('post_content_id', 'post_content_fk_6873921')->references('id')->on('post_contents');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_6873925')->references('id')->on('users');
        });
    }
}
