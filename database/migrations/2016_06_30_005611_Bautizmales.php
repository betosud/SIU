<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bautizmales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bautizmales',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idbarrio')->unasigned();
            $table->foreign('idbarrio')->references('id')->on('barrios');
            $table->string('bautizmode');
            $table->string('dirigidopor');
            $table->date('fecha');
            $table->time('hora');
            $table->string('direccion_himnos');
            $table->string('pianista');
            $table->string('himno_inicial');
            $table->string('oracion_inicial');
            $table->string('testigo1');
            $table->string('testigo2');
            $table->string('ordenanzapor');
            $table->string('actividades');
            $table->string('bienvenida');
            $table->string('himno_final');
            $table->string('oracion_final');
            $table->integer('asistencia');
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
        Schema::drop('bautizmales');
    }
}
