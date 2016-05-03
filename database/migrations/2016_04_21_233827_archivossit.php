<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Archivossit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivossit',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idsolicitud')->unsigned();
            $table->foreign('idsolicitud')->references('id')->on('solicitudes');
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('tipo');
            $table->double('monto');
            $table->string('rutaarchivo');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('archivossit');
    }
}
