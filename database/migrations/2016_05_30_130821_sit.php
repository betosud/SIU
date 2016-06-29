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
            $table->string('id');
            $table->integer('idsolicitud')->unsigned();
            $table->foreign('idsolicitud')->references('id')->on('solicitudes');
            $table->date('fecha');
            $table->integer('categoria');
            $table->integer('pteorganizacion');
            $table->integer('obispo');
            $table->integer('status');
            $table->integer('statuscomprobantes');
            $table->integer('enviooficinas');
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
        Schema::drop('sit');
    }
}
