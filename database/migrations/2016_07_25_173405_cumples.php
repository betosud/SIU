<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cumples extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cumples',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idbarrio')->unasigned();
            $table->foreign('idbarrio')->references('id')->on('barrios');
            $table->string('nombre');
            $table->date('fecha');
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
        //
    }
}
