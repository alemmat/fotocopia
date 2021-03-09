<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentroDeCopiadoPrecioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centro_de_copiado_precio', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('precio_id')->unsigned()->nullable();
            $table->foreign('precio_id')->references('id')->on('precios');
            $table->unsignedBigInteger('centro_de_copiado_id')->unsigned()->nullable();
            $table->foreign('centro_de_copiado_id')->references('id')->on('centro_de_copiados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centro_de_copiado_precio');
    }
}
