<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::create('post_submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->datetime('submit_at')->nullable();
            $table->float('mark', 15, 2)->nullable();
            $table->datetime('mark_at')->nullable();
            $table->integer('student_efk');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
