<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sit',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idestaca');
            $table->foreign('idestaca')->references('id')->on('estacas');
            $table->integer('idbarrio');
            $table->foreign('idbarrio')->references('id')->on('barrios');
            $table->string('idsit');
            $table->date('fecha');
            $table->date('fechasit');
            $table->string('solicitante');
            $table->string('mail');
            $table->string('pagable');
            $table->string('ife');
            $table->string('descripcion');
            $table->float('cantidad');
            $table->integer('organizaciongasto');
            $table->integer('categoria');
            $table->integer('tipopago')->unsigned();
            $table->foreign('tipopago')->references('id')->on('catalogos');
            $table->integer('obispo');
            $table->integer('pteorganizacion');
            $table->string('observaciones');
            $table->integer('status')->unsigned();
            $table->foreign('status')->references('id')->on('catalogos');
            $table->integer('statuscomprobantes')->unsigned();
            $table->foreign('statuscomprobantes')->references('id')->on('catalogos');
            $table->integer('enviado');
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
        Schema::drop('sit');
    }
}
