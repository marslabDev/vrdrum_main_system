<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('coach_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('enrollment_status');
            $table->integer('coach_efk');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
