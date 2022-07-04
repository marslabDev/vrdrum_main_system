<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostContentSubmitsTable extends Migration
{
    public function up()
    {
        Schema::create('post_content_submits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('desc')->nullable();
            $table->float('mark', 15, 2)->nullable();
            $table->string('objective_answers')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
