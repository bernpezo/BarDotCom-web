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
            $table->unsignedBigInteger('idUsuario')->nullable();
            $table->unsignedBigInteger('idCliente')->nullable();
            $table->unsignedBigInteger('idLocal')->nullable();
            $table->unsignedBigInteger('idMesa')->nullable();
            $table->timestamps();
            $table->foreign('idUsuario')->references('id')->on('usuario_locals')->onDelete('cascade');
            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('set null');
            $table->foreign('idLocal')->references('id')->on('local_comercials')->onDelete('cascade');
            $table->foreign('idMesa')->references('id')->on('mesas')->onDelete('set null');
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
