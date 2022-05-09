<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitResourcesTable extends Migration
{
    public function up()
    {
        Schema::create('submit_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('answer_text')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
