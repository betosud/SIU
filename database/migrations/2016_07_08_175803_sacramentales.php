<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sacramentales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sacramentales',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idbarrio')->unasigned();
            $table->foreign('idbarrio')->references('id')->on('barrios');
            $table->date('fecha');
            $table->time('hora');
            $table->string('preside');
            $table->string('direcicon_programa');
            $table->string('direccion_himnos');
            $table->string('pianista');
            $table->string('himno_inicial');
            $table->string('oracion_inicial');
            $table->string('himno_sacramental');
            $table->string('bendice1');
            $table->string('bendice2');
            $table->string('reparten');
            $table->string('himno_intermedio');
            $table->string('himno_final');
            $table->string('oracion_final');
            $table->integer('asistencia');
            $table->string('observaciones');
            $table->string('user_id');
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
        Schema::drop('sacramentales');
    }
}
