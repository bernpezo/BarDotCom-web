<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdministradorLocal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrador_locals', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('idLocal');
            $table->primary('id');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idLocal')->references('id')->on('local_comercials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrador_locals');
    }
}
