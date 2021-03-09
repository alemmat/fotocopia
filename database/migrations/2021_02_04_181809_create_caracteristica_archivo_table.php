<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaracteristicaArchivoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caracteristica_archivo', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('caracteristica_id')->unsigned()->nullable();
            $table->foreign('caracteristica_id')->references('id')->on('caracteristicas');
            $table->unsignedBigInteger('archivo_id')->unsigned()->nullable();
            $table->foreign('archivo_id')->references('id')->on('archivos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caracteristica_archivo');
    }
}
