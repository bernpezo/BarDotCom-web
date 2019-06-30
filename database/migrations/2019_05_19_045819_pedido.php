<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idLocal');
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idCliente');
            $table->unsignedBigInteger('idCuenta');
            $table->unsignedBigInteger('idMesa');
            $table->unsignedBigInteger('idItem');
            $table->integer('cantidadItem');
            $table->boolean('estado');
            $table->timestamp('fecha');
            $table->timestamps();
            $table->foreign('idLocal')->references('id')->on('local_comercials');
            $table->foreign('idUsuario')->references('id')->on('usuario_locals');
            $table->foreign('idCliente')->references('id')->on('clientes');
            $table->foreign('idCuenta')->references('id')->on('cuentas');
            $table->foreign('idMesa')->references('id')->on('mesas');
            $table->foreign('idItem')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
