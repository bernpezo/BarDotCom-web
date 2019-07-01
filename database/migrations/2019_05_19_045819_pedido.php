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
            $table->unsignedBigInteger('idLocal')->nullable();
            $table->unsignedBigInteger('idUsuario')->nullable();
            $table->unsignedBigInteger('idCliente')->nullable();
            $table->unsignedBigInteger('idCuenta')->nullable();
            $table->unsignedBigInteger('idMesa')->nullable();
            $table->unsignedBigInteger('idItem')->nullable();
            $table->integer('cantidadItem');
            $table->boolean('estado');
            $table->timestamp('fecha');
            $table->timestamps();
            $table->foreign('idLocal')->references('id')->on('local_comercials')->onDelete('cascade');
            $table->foreign('idUsuario')->references('id')->on('usuario_locals')->onDelete('cascade');
            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('set null');
            $table->foreign('idCuenta')->references('id')->on('cuentas')->onDelete('set null');
            $table->foreign('idMesa')->references('id')->on('mesas')->onDelete('set null');
            $table->foreign('idItem')->references('id')->on('items')->onDelete('set null');
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
