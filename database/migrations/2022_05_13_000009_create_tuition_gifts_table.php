<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTuitionGiftsTable extends Migration
{
    public function up()
    {
        Schema::create('tuition_gifts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->float('total_minute', 15, 2)->nullable();
            $table->float('quantity', 15, 2)->nullable();
            $table->integer('inventory_efk')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
