<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IngresoCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idLocal');
            $table->unsignedBigInteger('idMesa');
            $table->timestamps();
            $table->foreign('idUsuario')->references('id')->on('usuario_locals');
            $table->foreign('idCliente')->references('id')->on('clientes');
            $table->foreign('idLocal')->references('id')->on('local_comercials');
            $table->foreign('idMesa')->references('id')->on('mesas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingreso_clientes');
    }
}
