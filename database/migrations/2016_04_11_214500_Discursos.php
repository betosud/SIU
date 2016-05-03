<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Discursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discursos',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idbarrio');
            $table->foreign('idbarrio')->references('id')->on('barrios');
            $table->date('fecha');
            $table->time('hora');
            $table->string('nombre');
            $table->string('tema');
            $table->integer('duracion');
            $table->string('lugar');
            $table->binary('realizado');
            $table->integer('lider1')->unsigned();
            $table->foreign('lider1')->references('id')->on('lideres');
            $table->integer('lider2')->unsigned();
            $table->foreign('lider2')->references('id')->on('lideres');
            $table->integer('lider3')->unsigned();
            $table->foreign('lider3')->references('id')->on('lideres');
            $table->integer('user_id');
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
        Schema::drop('discursos');
    }
}
