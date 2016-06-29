<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AsuntosSacramentales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asuntos_sacramentales',function (Blueprint $table){
            $table->increments( 'id');
            $table->integer('idsacramental')->unsigned();
            $table->foreign('idsacramental')->references('id')->on('sacramentales');
            $table->string('descripcion');
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
        Schema::drop('asuntos_sacramentales');
    }
}
