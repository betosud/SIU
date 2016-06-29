<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lideres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lideres',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idbarrio');
            $table->foreign('idbarrio')->references('id')->on('barrios');
            $table->string('llamamiento');
            $table->string('nombre');
            $table->string('email');
            $table->string('phone');
            $table->string('organizacion');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lideres');
    }
}
