<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Entrevistas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrevistas',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idbarrio');
            $table->foreign('idbarrio')->references('id')->on('barrios');
            $table->date('fecha');
            $table->time('hora');
            $table->string('nombre');
            $table->string('entrevistador');
            $table->string('duracion');
            $table->string('lugar');
            $table->binary('realizado');
            $table->integer('lider1');
            $table->integer('lider2');
            $table->integer('lider3');
            $table->integer('user_id');
            $table->string('token');
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
        Schema::drop('entrevistas');
    }
}
