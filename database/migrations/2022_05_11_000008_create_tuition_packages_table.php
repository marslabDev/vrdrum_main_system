<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTuitionPackagesTable extends Migration
{
    public function up()
    {
        Schema::create('tuition_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('price', 15, 2);
            $table->float('total_minute', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
