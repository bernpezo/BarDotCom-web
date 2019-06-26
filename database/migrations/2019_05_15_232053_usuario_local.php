<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsuarioLocal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_locals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idUser')->nullable();
            $table->unsignedBigInteger('idLocal');
            $table->timestamps();
            $table->foreign('idUser')->references('id')->on('users')->onDelete('set null');
            $table->foreign('idLocal')->references('id')->on('local_comercials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_locals');
    }
}
