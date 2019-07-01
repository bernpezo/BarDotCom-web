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
            $table->unsignedBigInteger('idLocal')->nullable();
            $table->unsignedBigInteger('idUsuario')->nullable();
            $table->unsignedBigInteger('idCliente')->nullable();
            $table->unsignedBigInteger('idMesa')->nullable();
            $table->integer('total');
            $table->boolean('estado');
            $table->timestamp('fecha');
            $table->timestamps();
            $table->foreign('idLocal')->references('id')->on('local_comercials')->onDelete('cascade');
            $table->foreign('idUsuario')->references('id')->on('usuario_locals')->onDelete('cascade');
            $table->foreign('idCliente')->references('id')->on('clientes')->onDelete('set null');
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
        Schema::dropIfExists('cuentas');
    }
}
