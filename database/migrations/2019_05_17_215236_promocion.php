<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Promocion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('idLocal');
            $table->string('nombre');
            $table->string('descripcion',500);
            $table->string('imagen');
            $table->timestamps();
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
        Schema::dropIfExists('promocions');
    }
}
