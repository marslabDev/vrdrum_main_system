<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostContentsTable extends Migration
{
    public function up()
    {
        Schema::create('post_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('resource_type');
            $table->string('submit_type')->nullable();
            $table->string('title');
            $table->longText('desc')->nullable();
            $table->float('mark', 15, 2)->nullable();
            $table->boolean('required_response')->default(0)->nullable();
            $table->string('objective_selections')->nullable();
            $table->string('objective_answers')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
