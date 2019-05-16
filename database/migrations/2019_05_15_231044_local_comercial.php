<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LocalComercial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_comercials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_admin');
            $table->string('rut')->unique();
            $table->string('nombre');
            $table->string('logo');
            $table->string('email');
            $table->string('direccion');
            $table->unsignedBigInteger('comuna');
            $table->integer('telefono');
            $table->unsignedBigInteger('rubro');
            $table->string('descripcion',500);
            $table->timestamps();
            $table->foreign('rubro')->references('id')->on('rubros');
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
        Schema::dropIfExists('local_comercials');
    }
}
