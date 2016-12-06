<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MailsEnviados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailsenviados',function (Blueprint $table){
            $table->increments('id');
            $table->integer('idbarrio')->unasigned();
            $table->foreign('idbarrio')->references('id')->on('barrios');
            $table->string('to');
            $table->string('for');
            $table->string('name');
            $table->string('subjet');
            $table->timestamps();

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
