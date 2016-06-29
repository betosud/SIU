<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bancos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bancos',function (Blueprint $table){
            $table->increments('id');
            $table->string('nombre');
            $table->string('siglas');
            $table->string('rutalogo');
            $table->string('convenio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bancos');
    }
}
