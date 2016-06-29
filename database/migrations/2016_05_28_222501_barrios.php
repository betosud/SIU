<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Barrios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barrios', function (Blueprint $table){
            $table->integer('id')->unique();
            $table->primary('id');
            $table->integer('idestaca');
            $table->foreign('idestaca')->references('id')->on('estacas');
            $table->string('nombreunidad');
            $table->string('email');
            $table->string('passwemail',60);
            $table->string('nombrecalendario',60);
            $table->string('apicalendario',60);
            $table->integer('idbanco');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('barrios');
    }
}
