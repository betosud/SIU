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
            $table->increments( 'id');
            $table->integer('idbarrio');
            $table->foreign('idbarrio')->references('id')->on('barrios');
            $table->date('fecha');
            $table->time('hota');
            $table->string('presidir');
            $table->string('direccion');
            $table->string('oracioninicial');
            $table->string('himnoinicial');
            $table->string('direccionhimnos');
            $table->string('piano');
            $table->string('bendice1');
            $table->string('bendice2');
            $table->string('reparten');
            $table->string('himnofinal');
            $table->string('oracionfinal');
            $table->string('asistencia');
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
