<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('path')->unique();
            $table->string('numero_de_paginas');
            $table->unsignedBigInteger('trabajo_id')->unsigned()->nullable();
            $table->foreign('trabajo_id')->references('id')->on('trabajos');
            $table->enum('estado', ['finalizado', 'pendiente'])->default('pendiente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos');
    }
}
