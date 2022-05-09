<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachMetaTable extends Migration
{
    public function up()
    {
        Schema::create('coach_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('meta_key');
            $table->string('meta_value')->nullable();
            $table->integer('coach_efk');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
