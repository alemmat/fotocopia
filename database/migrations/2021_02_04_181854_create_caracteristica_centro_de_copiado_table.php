<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaracteristicaCentroDeCopiadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caracteristica_centro_de_copiado', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('caracteristica_id')->unsigned()->nullable();
            $table->foreign('caracteristica_id')->references('id')->on('caracteristicas');
            $table->unsignedBigInteger('centro_de_copiado_id')->unsigned()->nullable();
            $table->foreign('centro_de_copiado_id')->references('id')->on('centro_de_copiados');
            $table->float('precio', 8, 2)->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caracteristica_centro_de_copiado');
    }
}
