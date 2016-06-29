<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Solicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idestaca');
//            $table->foreign('idestaca')->references('id')->on('estacas');
            $table->integer('idbarrio');
            $table->foreign('idbarrio')->references('id')->on('barrios');
            $table->date('fecha');
            $table->string('solicitante');
            $table->string('mail');
            $table->string('pagable');
            $table->string('ife');
            $table->string('descripcion');
            $table->float('cantidad');
            $table->integer('organizacion');
            $table->integer('tipopago');
            $table->string('observaciones');
            $table->integer('status');
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
        Schema::drop('solicitudes');
    }
}
