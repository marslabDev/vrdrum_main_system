<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('work_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content');
            $table->integer('sender_efk');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
