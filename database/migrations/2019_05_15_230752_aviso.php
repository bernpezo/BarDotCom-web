<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Aviso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avisos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_admin');
            $table->string('nombre');
            $table->string('descripcion',500);
            $table->timestamps();
            $table->foreign('id_admin')->references('id_admin')->on('administrador_sistemas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avisos');
    }
}
