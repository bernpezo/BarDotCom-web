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
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('idLocal');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('id')->references('id')->on('users');
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
