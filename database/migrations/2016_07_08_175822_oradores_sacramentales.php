<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OradoresSacramentales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oradores_sacramentales',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idprograma');
            $table->string('nombre');
            $table->string('tema');
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
        Schema::drop('oradores_sacramentales');
    }
}
