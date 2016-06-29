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
            $table->integer('idsit')->unsigned();
            $table->foreign('idsit')->references('id')->on('sit');
            $table->string('nombrearchivo');
            $table->string('descripcionarchivo');
            $table->string('tipoarchivo');
            $table->double('montoarchivo');
            $table->string('rutaarchivo');
            $table->string('subidopor');
            $table->integer('validadopor');
            $table->string('tokenarchivo');
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
