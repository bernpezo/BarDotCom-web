<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cuenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idLocal');
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idMesa');
            $table->integer('total');
            $table->boolean('estado');
            $table->timestamp('fecha');
            $table->timestamps();
            $table->foreign('idLocal')->references('id')->on('local_comercials');
            $table->foreign('idUsuario')->references('id')->on('usuario_locals');
            $table->foreign('idCliente')->references('id')->on('clientes');
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
        Schema::dropIfExists('cuentas');
    }
}
